<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Note\NoteController;
use App\Http\Requests\NoteRequest;
use App\Lib\Capture\ScreenCapture;
use App\Lib\Template\TemplateMerge;
use App\Models\EmailTemplate;
use App\Models\Fgp\Section;
use App\Models\SiteSettings;
use App\Models\User;
use Exception;

class BaseController extends Controller
{
    protected $layout;

    public function __construct()
    {
        $this->layout = config('site.template');
    }

    public function response($message, $data, $statusCode = 200, $header = null)
    {
        $successError = null;

        if ($statusCode >= 200 && $statusCode <= 226) {
            $successError = 'success';
        } else {
            $successError = 'error';
            // $statusCode = 500;
        }

        $arrStatus = ['type' => $successError, 'data' => $message, 'element' => $data];
        //$arrView = ['type' => 'view', 'data' => $data];

        if (is_array($header)) {
            return response()->json([$arrStatus], $statusCode)->withHeaders($header);
        } else {
            return response()->json([$arrStatus], $statusCode);
        }

    }

    /**
     * Response Lookup
     * @param  array $collections
     * @param  array $columns
     * @return array
     */

    public function responseLookup($collections, $columns = null)
    {
        $lookupData = [];
        $value = null;

        if ($collections) {
            foreach ($collections as $key => $data) {
                $value = null;
                if (count($columns)) {
                    if (count($columns) <= 1) {
                        $value = ucfirst($data[$columns[0]]);
                    } else {
                        foreach ($columns as $key => $col) {
                            if (isset($data->{$col}) && !is_null($data->{$col})) {
                                $value .= ucfirst($data->{$col}) . " ";
                            }
                        }
                        $value = trim($value);
                    }
                    array_push($lookupData, ["id" => $data->id, "value" => $value]);
                }
            }
        }
        return $lookupData;
    }

    /**
     * @param $letterName
     * @param $model
     * @return bool
     */
    protected function makeTemplate($letterName, $model)
    {
        if ($model instanceof Model) {
            $data = $model->getAttributes();
        } elseif (is_array($model) || is_object($model)) {
            $data = $model;
        } else {
            return false;
        }

        $template = EmailTemplate::where('temp_code', $letterName)->first();
        $temp = TemplateMerge::makeTemplate($template, $data);
        return $temp;
    }

    /**
     * @param $data
     * @param $letterName
     * @return mixed|string
     */
    protected function generateFile($data, $letterName, $modeM = '')
    {
        $content = "";
        if ($data instanceof Model) {
            $content = $this->makeTemplate($letterName, $data);
        } elseif ($letterName == 'Approved letter') {
            foreach ($data as $d):
                $content .= $this->makeTemplate($letterName, $d);
                $content .= '<div style="margin-top: 20px; height:50px"></div>';
            endforeach;
            $providers = \App\Models\ProviderList::all();
            $content .= view('default.print.providerList', compact('providers'));
        } elseif ($letterName == 'Surgery Certificates IE') {
            $len = count($data);

            //getting the slap as [3,3,2] for 8 [3,1] for 4
            $slapArr = $this->getSlap($len);

            $index = 0;
            for ($i = 0; $i < count($slapArr); $i++) {
                $cnt = 0 + $index; // defining the starting index for next slap
                for ($j = 0; $j < $slapArr[$i]; $j++) {
                    $content .= $this->makeTemplate($letterName, $data[$cnt]);
                    $content .= '<div style="margin-top: 50px;"></div>';
                    $cnt++;
                }

                $space = 370;
                if ($slapArr[$i] % 3 == 2) {
                    $space = (string) $space;
                    $content .= '<div style="height: ' . $space . 'px;"></div>';
                } elseif ($slapArr[$i] % 3 == 1) {
                    $space = (string) (($space) * 2);
                    $content .= '<div style="height: ' . $space . 'px;"></div>';
                } else {
                    $content .= '<div style="height: 11px;"></div>';
                }

                $cnt = 0 + $index;
                for ($j = 0; $j < $slapArr[$i]; $j++) {
                    $content .= $this->makeTemplate('Surgery Information', $data[$cnt]);
                    $content .= '<div style="margin-top: 50px;"></div>';
                    $cnt++;
                }

                $index = 3;
            } //end main for

        } else {
            foreach ($data as $d):
                $content .= $this->makeTemplate($letterName, $d);
                $content .= '<div style="margin-top: 20px;"></div>';
            endforeach;
        }

        $screenCapture = new ScreenCapture();
        if ($letterName == 'Surgery Certificates IE') {
            $path = $screenCapture->load(htmlspecialchars_decode($content), 'no_footer');
        } else {
            $path = $screenCapture->load(htmlspecialchars_decode($content));
        }

        //replace full path with absolute
        $abPath = storage_path('uploads' . DIRECTORY_SEPARATOR);
        $path = str_replace($abPath, '', $path);

        return $path;
    }

    /**
     * @param $model
     * @param $title
     * @param string $type
     * @param string $notes
     */
    protected function note($model, $title, $type = 'Task', $activity = 'Application', $notes = "")
    {
        $note = new NoteController();
        $data['table_name'] = $model->getTable();
        $data['table_id'] = $model->id;
        $data['note_type'] = $type;
        $data['activity'] = 'Application';
        $data['start'] = date('y-m-d H:i:s');
        $data['end'] = date('y-m-d H:i:s');
        $data['title'] = $title;
        $data['notes'] = $notes !== '' ? $notes : $title;
        $data['status'] = 'Done';
        $note->noteStore(new NoteRequest($data));
    }

    protected function performComparision($data, $compareString)
    {
        $list = ['<=', '==', '>'];
        foreach ($list as $l) {
            if (hasOperator($compareString, $l)) {
                $d = (int) str_replace($l, '', $compareString);
                if (is_int($d) && $d != 0) {
                    switch ($l) {
                        case '<':
                            return $data < $d;
                        case '<=':
                            return $data <= $d;
                        case '>':
                            return $data > $d;
                        case '>=':
                            return $data >= $d;
                        case '==':
                            return $data == $d;
                        default:
                            return false;
                    }
                } else {
                    return false;
                }

            }
        }
        return false;
    }

    private function getSlap($len)
    {
        $val = floor($len / 3);
        $rem = $len % 3;

        $count = $rem == 0 ? $val : $val + 1;
        $arr = [];
        for ($i = 1; $i <= $count; $i++) {
            if ($i > $val) {
                array_push($arr, $rem);
            } else {
                array_push($arr, 3);
            }

        }

        return $arr;

    }

    protected function get_full_message(Exception $e)
    {
        return ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()];
    }

    protected function view($view_path, $compact_data = array())
    {
        if ($current_user = auth()->user()):
            $compact_data['current_user'] = $current_user->only(['name', 'email', 'role_id', 'co_no', 'id']);
            if ($member = $current_user->member):
                $compact_data['current_user'] = array_merge($compact_data['current_user'], $name = $member->only(['first_name', 'middle_name', 'last_name']));
                $compact_data['current_user']['full_name'] = implode(' ', $name);
            endif;
            $compact_data['current_user'] = save_update(app(User::class), $compact_data['current_user'], false);
        endif;

        return view(view()->exists($view_path) ? $view_path : $this->layout . '.' . $view_path, $compact_data);
    }
}
