<?php




namespace App\Http\Controllers\Layout;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\LayoutBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LayoutController extends BaseController
{
    /**
     * @var null
     */
    private static $repo = null;
    /**
     * @var string
     */
    private $clayout = '';

    /**
     * ClientController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.layout_builder.';
    }

    public function index()
    {
        $layoutSettings = DB::table('builder_setting')->get()->keyBy('setting_label')->toArray();
        return view($this->clayout.'index', ['layoutSettings' => $layoutSettings]);
    }

    public function update(Request $request)
    {
        
        // Reset All to Default
        $this->resetToDefault();

        // After Reset changed only requested Fields
        foreach ($request->all() as $key => $value) {
            LayoutBuilder::where('setting_label', trim($key))->where('user_id', Auth::id())->where('is_deleted', 0)->update(['applied_value' => $value]);
        }
    }

    private function hasSetting()
    {
        return LayoutBuilder::where('user_id', Auth::id())->exists();
    }

    public function resetToDefault()
    {
        $setting = array(
            1 => array(
                'layout_type' => 'fluid'
            ),
            2 => array(
                'page_background' => 'lightgray'
            ),
            3 => array(
                'desktop_fixed_header' => "on"
            ),
            4 => array(
                'desktop_header_minimize_mode' => 'none'
            ),
            5 => array(
                'mobile_fixed_header' => "on"
            ),
            6 => array(
                'display_header_menu' => "on"
            ),
            7 => array(
                'dropdown_skin' => 'light'
            ),
            8 => array(
                'display_submenu_arrow' => "on"
            ),
            9 => array(
                'aside_skin' => 'dark'
            ),
            10 => array(
                'fixed_aside' => "on"
            ),
            11 => array(
                'allow_aside_minimizing' => "off"
            ),
            12 => array(
                'default_minimized_aside' => "off"
            ),
            13 => array(
                'default_hidden_aside' => "off"
            ),
            14 => array(
                'fixed_footer' => "off"
            ),
            15 => array(
                'global_page_background' => 'none'
            ),
            16 => array(
                "global_font_size" => 18
            )
        );

        if(LayoutBuilder::where('user_id', Auth::id())->exists()) {
            LayoutBuilder::where('user_id', Auth::id())->delete();
        }

        foreach($setting as $key => $value) {
            $builder = new LayoutBuilder();
            $builder->user_id = Auth::id();
            $builder->setting_label = key($value);
            $builder->applied_value = $value[key($value)];
            $builder->save();
        }

    }

    public function resetConfirm()
    {
        return view($this->clayout.'modal.reset');
    }

}
