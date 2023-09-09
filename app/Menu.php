<?php

namespace App;

use App\Model;

class Menu extends Model
{

    public function content()
    {
        return $this->hasOne(Content::class, 'menu_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent');
    }

    public function parentMenu()
    {
        return $this->belongsTo(self::class, 'parent');
    }

    public function getMenus($parent, $limit = null, $opt = null, $sortBy = 'priority', $sortOrder = 'asc')
    {
        $query = $this->where('status', 1)->where('parent', $parent)->where('school_id', school('id'));
        $query = $query->sort($sortBy, $sortOrder);
        if (!(int)$limit) {
            return $query->get();
        } else
            if ($opt == 'paginate') {
                return $query->paginate((int)$limit);
            } else
                if ($opt == 'random') {
                    return $query->inRandomOrder()->limit($limit)->get();
                } else {
                    return $query->limit($limit)->get();
                }

    }

    public function getMenusAll($onlyActive = false, $sortBy = 'priority', $sortOrder = 'asc')
    {
        if ($onlyActive) {
            $listFullMenu = $this->getMenuActive($sortBy, $sortOrder = 'asc');
        } else {
            $listFullMenu = $this->getMenuFull($sortBy, $sortOrder = 'asc');
        }
        return $listFullMenu;
    }

    public function getMenuActive($sortBy = 'priority', $sortOrder = 'asc')
    {
        $listFullMenu = $this->where([['status', 1], ['school_id', school('id')]])
            ->orderBY($sortBy, $sortOrder)
            ->get()
            ->groupBy('parent');
        return $listFullMenu;
    }

    public function getMenuFull($sortBy = 'priority', $sortOrder = 'asc')
    {
        $listFullMenu = $this->where('school_id', school('id'))->orderBY($sortBy, $sortOrder)
            ->get()
            ->groupBy('parent');
        return $listFullMenu;
    }

    public function getTreeMenu($parent = 0, $tree = null, $categories = null, $st = '')
    {
        $categories = $categories ?? $this->getMenusAll(true);
        $tree = $tree ?? [];
        $lisCategory = $categories[$parent] ?? [];
        foreach ($lisCategory as $category) {
            $tree[$category->id] = $st . $category->name;
            if (!empty($categories[$category->id])) {
                $st .= '--';
                $this->getTreeMenu($category->id, $tree, $categories, $st);
                $st = '';
            }
        }
        return $tree;
    }

    /*
        private function getCategories($parentId = 0)
        {
            $categories = [];
            $categorys = Menu::where('parent', $parentId)->where('status', 1)->get();
            foreach ($categorys as $category) {
                $categories = [
                    'item' => $category,
                    'children' => $this->getCategories($category->id)
                ];
            }

            return $categories;
        }*/
    public function insertMenusFirst($school_id)
    {
        $findMenu = $this->where([['name', 'LIKE', 'Home'], ['school_id', $school_id]])->orWhere([['name', 'LIKE', 'About Us'], ['school_id', $school_id]])->first();

        if (empty($findMenu)) {
            $data = [
                ['school_id' => $school_id, 'name' => 'Home', 'priority' => 1, 'url' => 1, 'slug' => '/', 'type' => 1, 'status' => 1],
                ['school_id' => $school_id, 'name' => 'About Us', 'priority' => 2, 'url' => 2, 'slug' => '#', 'type' => 1, 'status' => 1],
                ['school_id' => $school_id, 'name' => 'Teachers', 'priority' => 3, 'url' => 1, 'slug' => 'teacher', 'type' => 1, 'status' => 1],
                ['school_id' => $school_id, 'name' => 'Events', 'priority' => 4, 'url' => 1, 'slug' => 'event', 'type' => 1, 'status' => 1],
                ['school_id' => $school_id, 'name' => 'Gallery', 'priority' => 5, 'url' => 1, 'slug' => 'gallery', 'type' => 1, 'status' => 1],
                ['school_id' => $school_id, 'name' => 'Results', 'priority' => 6, 'url' => 1, 'slug' => 'academic-results', 'type' => 1, 'status' => 2],
                ['school_id' => $school_id, 'name' => 'Admission', 'priority' => 7, 'url' => 2, 'slug' => '#', 'type' => 1, 'status' => 1],
                ['school_id' => $school_id, 'name' => 'Contact', 'priority' => 8, 'url' => 1, 'slug' => 'contact', 'type' => 1, 'status' => 1],
                ['school_id' => $school_id, 'name' => 'Payment', 'priority' => 9, 'url' => 1, 'slug' => 'pay-online', 'type' => 1, 'status' => 2],
            ];
            $this->insert($data);
            $aboutMenu = $this->byschool($school_id)->where('name', 'LIKE', '%About Us%')->first();
            if ($aboutMenu) {
                $aboutSubMenu = [
                    ['school_id' => $school_id, 'name' => 'Committee', 'parent' => $aboutMenu->id, 'priority' => 1, 'url' => 1, 'slug' => 'committee', 'type' => 1, 'status' => 1],
                    //['school_id' => $school_id, 'name' => 'Members', 'parent' => $aboutMenu->id, 'priority' => 1, 'url' => 1, 'slug' => 'members', 'type' => 1, 'status' => 1],
                    //['school_id' => $school_id, 'name' => 'Managements', 'parent' => $aboutMenu->id, 'priority' => 1, 'url' => 1, 'slug' => 'managements', 'type' => 1, 'status' => 1],
                    ['school_id' => $school_id, 'name' => 'Our School', 'parent' => $aboutMenu->id, 'priority' => 2, 'url' => 1, 'slug' => 'about', 'type' => 1, 'status' => 1],
                    ['school_id' => $school_id, 'name' => 'Chairman Message', 'parent' => $aboutMenu->id, 'priority' => 3, 'url' => 1, 'slug' => 'chairman-message', 'type' => 1, 'status' => 1],
                    ['school_id' => $school_id, 'name' => 'Head Teacher Message', 'parent' => $aboutMenu->id, 'priority' => 4, 'url' => 1, 'slug' => 'headteacher-message', 'type' => 1, 'status' => 1],
                ];
                $this->insert($aboutSubMenu);
            }
            $admissionMenu = $this->byschool($school_id)->where('name', 'LIKE', '%Admission%')->first();
            if ($admissionMenu) {
                $addSubMenu = [
                    ['school_id' => $school_id, 'name' => 'Apply Admission', 'parent' => $admissionMenu->id, 'priority' => 1, 'url' => 1, 'slug' => 'admission/apply', 'type' => 1, 'status' => 1],
                    ['school_id' => $school_id, 'name' => 'Admission Form Download', 'parent' => $admissionMenu->id, 'priority' => 2, 'url' => 1, 'slug' => 'admission/download', 'type' => 1, 'status' => 1],
                    ['school_id' => $school_id, 'name' => 'Verify Admission', 'parent' => $admissionMenu->id, 'priority' => 3, 'url' => 1, 'slug' => 'admission/verify', 'type' => 1, 'status' => 1],
                    ['school_id' => $school_id, 'name' => 'Admitcard', 'parent' => $admissionMenu->id, 'priority' => 4, 'url' => 1, 'slug' => 'admission/admitcard', 'type' => 1, 'status' => 1],
                    ['school_id' => $school_id, 'name' => 'Merit List', 'parent' => $admissionMenu->id, 'priority' => 5, 'url' => 1, 'slug' => 'admission/meritlist', 'type' => 1, 'status' => 1],
                    ['school_id' => $school_id, 'name' => 'First Waiting List', 'parent' => $admissionMenu->id, 'priority' => 6, 'url' => 1, 'slug' => 'admission/waiting_step_1', 'type' => 1, 'status' => 2],
                    ['school_id' => $school_id, 'name' => 'Second Waiting List', 'parent' => $admissionMenu->id, 'priority' => 7, 'url' => 1, 'slug' => 'admission/waiting_step_2', 'type' => 1, 'status' => 2],
                    ['school_id' => $school_id, 'name' => 'Third Waiting List', 'parent' => $admissionMenu->id, 'priority' => 8, 'url' => 1, 'slug' => 'admission/waiting_step_3', 'type' => 1, 'status' => 2]
                ];
                $this->insert($addSubMenu);
            }
            $search_menu = $this->byschool($school_id)->where('slug', 'LIKE', '%chairman-message%')->first();
            $this->contentCreate($search_menu);
            $search_menu = $this->byschool($school_id)->where('slug', 'LIKE', '%headteacher-message%')->first();
            $this->contentCreate($search_menu);
        }
    }

    protected function contentCreate($menu)
    {
        Content::create([
            'school_id' => $menu->school_id,
            'menu_id' => $menu->id,
            'title' => $menu->name,
            'description' => $menu->name
        ]);
    }
}
