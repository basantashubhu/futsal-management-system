<?php


namespace App\Lib\Filter\NoteFilter;

use App\Lib\Filter\AbstractFilter;
use Illuminate\Support\Facades\DB;

class NoteFilter extends AbstractFilter
{
    public function activity($activity = '')
    {
        if ($activity != '') {
            return $this->builder->where('activity', $activity);
        }
        return $this->builder;
    }

    public function title($title = '')
    {
        if ($title != '') {
            return $this->builder->where('notes.title', 'LIKE', "%$title%");
        }
        return $this->builder;
    }
    public function tablename($name = '')
    {
        if ($name != '') {
            return $this->builder->where('table_name', $name);
        }
        return $this->builder;
    }

    public function tableid($id = '')
    {
        if ($id != '') {
            return $this->builder->where('table_id', $id);
        }
        return $this->builder;
    }

    public function priority($priority = false)
    {
        if (!$priority) {
            return;
        }
        if(is_array($priority))
        $this->builder->whereIn('priority', $priority);
    }

    public function note_type($type = false)
    {
        if (!$type) {
            return;
        }
        if(is_array($type))
            $this->builder->whereIn('notes.note_type', $type);
        else
            $this->builder->where('notes.note_type', $type);
    }

    public function volunteer($name = false)
    {
        if (!$name) {
            return;
        }

        $this->builder->whereRaw('concat(volunteers.first_name, " ", volunteers.last_name) like ?', ["%$name%"]);
    }

    public function site($site = false)
    {
        if (!$site) {
            return;
        }

        $this->builder->whereRaw('sites.site_name like ?', ["%$site%"]);
    }

    public function status($status = false)
    {
        if (!$status) {
            return;
        }
        if(is_array($status))
        $this->builder->whereIn('notes.status', $status);
    }

    public function user($name)
    {
        if (!$name) {
            return;
        }
        if (is_numeric($name)) {
            return $this->builder->where('notes.userc_id', $name);
        }
        $this->builder->whereRaw('concat(m.first_name, " ",m.last_name) like ?', ["%$name%"]);
    }

    public function date_range($range, $data)
    {
        if (!$range) {
            return;
        }

        $range = explode(' - ', $range);
        if (!count($range)) {
            return;
        }
        $d = collect($data);
        $date_type = $d->where('name', 'date_type')->first()->value ?? 'created_at';
        $range = [date('Y-m-d', strtotime($range[0])), date('Y-m-d', strtotime($range[1]))];
        $this->builder->whereBetween(DB::raw("date(notes.$date_type)"), $range);
    }

    public function volunteer_alt($alt)
    {
        if (!$alt) {
            return;
        }

        $this->builder->where('volunteers.alt_id', $alt);
    }

    public function vol_cell($cell)
    {
        if (!$cell) {
            return;
        }
        $this->builder->leftjoin('contacts', function ($join) {
            $join->on('contacts.table_id', 'volunteers.id')
                ->on('contacts.table_name', \DB::raw('"volunteers"'));
        })->where('contacts.cell_phone', $cell);
    }

    public function with_vol($value)
    {
        if (!$value) {
            return;
        }

        $this->builder->whereRaw('notes.vol_id <> ""');
    }

    public function with_site($value)
    {
        if (!$value) {
            return;
        }

        $this->builder->whereRaw('notes.site_id <> ""');
    }

    public function seen($value)
    {
        if (!$value) {
            return;
        }

        $this->builder->where('notes.is_seen', $value);
    }

    public function stipend_period($period)
    {
        if (!$period) {
            return;
        }

        $this->builder->where('notes.period_id', $period);
    }

    public function ids($ids = false)
    {
        if(!$ids) return;
        $ids = explode(',', $ids);
        $this->builder->whereIn('notes.id', $ids);
    }
}
