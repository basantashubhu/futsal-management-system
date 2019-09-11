<?php
/**
 * @author Suman Thaapa -- Lead
 * @author Prabhat gurung
 * @author Basanta Tajpuriya
 * @author Rakesh Shrestha
 * @author Manish Buddhacharya
 * @author Lekh Raj Rai
 * @author Ascol Parajuli
 * @email NEPALNME@GMAIL.COM
 * @create date 2019-03-12 16:51:56
 * @modify date 2019-03-12 16:51:56
 * @desc [description]
 */

namespace App\Http\Controllers\Fgp;

use App\Http\Controllers\BaseController;
use App\Models\Fgp\TableField;
use App\Models\Fgp\TableMaintenance;
use App\Repo\FGP\TableMaintenanceRepo;
use DB;
use Illuminate\Http\Request;

class MaintenanceController extends BaseController
{
    private static $repo = null;
    private $clayout = "";
    private $db = "";
    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.fgp.maintenance.';
        ini_set('max_execution_time', 1800000);
        $this->db = DB::getDatabaseName();
    }

    public function index()
    {
        $tables = TableMaintenance::where('is_deleted', false)->get();
        if (count($tables) > 0) {
            $firstItem = $tables[0];
        } else {
            $firstItem = false;
        }
        return view($this->clayout . 'index', compact('tables', 'firstItem'));
    }

    /**
     * @param $model
     * @return TableMaintenanceRepo|null
     */
    private static function getInstance($model)
    {
        if (self::$repo == null) {
            self::$repo = new TableMaintenanceRepo($model);
        }

        return self::$repo;
    }

    public function getAllTable(Request $request)
    {
        $data = self::getInstance('FGP\TableMaintenance')->selectDataTable($request);
        return $data;
    }

    public function getTableDesc($id)
    {
        $table = TableMaintenance::find($id);
        return ['id' => $table->id, 'description' => $table->description];
    }

    public function viewTable($id)
    {
        $table = TableMaintenance::find($id);
        $labels = TableField::where('table_man_id', $table->id)->pluck('label');
        $results = DB::table($table->table_name)
            ->when($labels->contains('is_deleted'), function ($query) {
                $query->where('is_deleted', 0);
            })
            ->get();
        if (count($results) > 0) {
            $i = 0;
            $fields = [];
            foreach ($results[0] as $k => $v) {
                if ($i < 5) {
                    array_push($fields, $k);
                }
                $i++;
            }
            $data = cleaner($fields, $results);
            $firstItem = $results[0];
        } else {
            $firstItem = false;
        }
        return view($this->clayout . 'modal.viewTable', compact('results', 'labels', 'table', 'fields', 'data', 'firstItem'));
    }

    public function singleRowDetail($table, $id)
    {
        $table1 = TableMaintenance::where('table_name', $table)->first();
        $labels = TableField::where('table_man_id', $table1->id)->pluck('label');
        $result = DB::table($table)->select($table . '.*')->where('id', $id)->first();
        return view($this->clayout . 'modal.singleRowDetail', compact('result', 'labels'));
    }

    //update table data
    public function updateTableData(Request $request, $table, $id)
    {
        foreach ($request->all() as $k => $v) {
            $data = DB::table($table)->where('id', $id)->update([$k => $v]);
        }
        $res = DB::table($table)->where('id', $id)->first();
        return $this->response("Table Data Updated Successfully", ["view"], 200);
    }

    //delete table data
    public function deleteSelectedData($table, $id)
    {
        return view($this->clayout . 'modal.deleteTableData', compact('table', 'id'));
    }
    public function deleteTableData(Request $request, $table, $id)
    {
        $data = DB::table($table)->where('id', $id)->update(['is_deleted' => 1]);
        return $this->response("Successfully deleted data", 'view', 200);
    }

    //edit table
    public function editTable($id)
    {
        $table = TableMaintenance::find($id);
        $data = TableField::where('table_man_id', $table->id)->get();
        $tableField = TableMaintenance::where('table_name', 'table_fields')->first();
        $fields = TableField::where('table_man_id', $tableField->id)->limit(7)->pluck('label');
        return view($this->clayout . 'modal.editTable', compact('data', 'table', 'fields'));
    }
    //update Table
    public function updateTable(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $a_table = TableMaintenance::find($id);
            $f_table = $request->mainTable;
            foreach ($f_table as $f) {
                $a_table->label = $f['label'];
                $a_table->description = $f['description'];
                $a_table->save();
            }
            $f_fields = $request->tableField;
            foreach ($f_fields as $field) {
                $ff = TableField::find($field['field_id']);
                $ff->label = $field['field_label'];
                $ff->description = $field['field_description'];
                $ff->save();
            }
            DB::commit();
            return $this->response("Field Labels and Description updated", "view", 200);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return $this->response("Table Fields and Description cannot update", "view", 422);
        }
    }

    //Sync all table and its fields
    public function syncTable()
    {
        // dd($this->db);
        $t = "Tables_in_" . $this->db;
        $tables = DB::select('SHOW TABLES');
        // dd($tables);
        $maintenance = TableMaintenance::where('is_deleted', false)->get();
        $fields = TableField::where('is_deleted', false)->get();
        DB::beginTransaction();
        try {
            if (count($maintenance) > 0) {
                foreach ($maintenance as $main):
                    $fields = DB::getSchemaBuilder()->getColumnListing($main->table_name);
                    $existingFields = TableField::where('table_man_id', $main->id)->get();
                    if (count($existingFields) > 0) {
                        foreach ($fields as $k => $v) {
                            if ($v != $existingFields[$k]->field_name) {
                                $in = new TableField();
                                $in->table_man_id = $main->id;
                                $in->label = $v;
                                $in->field_name = $v;
                                $in->description = $v;
                                $in->save();
                            }
                        }
                    } else {
                        foreach ($fields as $f):
                            $field = new TableField();
                            $field->table_man_id = $main->id;
                            $field->label = $f;
                            $field->field_name = $f;
                            $field->description = $f;
                            $field->save();
                        endforeach;
                    }
                endforeach;
            } else {
                $i = 1;
                foreach ($tables as $table):
                    $m = new TableMaintenance();
                    $m->table_name = $table->$t;
                    $m->label = ucfirst($table->$t);
                    $m->description = ucfirst($table->$t);
                    $m->seq_no = $i++;
                    $m->save();

                    $fields = DB::getSchemaBuilder()->getColumnListing($m->table_name);
                    foreach ($fields as $f):
                        $field = new TableField();
                        $field->table_man_id = $m->id;
                        $field->label = $f;
                        $field->field_name = $f;
                        $field->description = $f;
                        $field->save();
                    endforeach;
                endforeach;
            }
            DB::commit();
            return $this->response("All Tables and Fields are Synced Properly", "view", 200);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return $this->response("Something is wrong in datatabase table or in its fields", "view", 422);
        }
    }
}
