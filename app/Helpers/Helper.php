<?php
//file Helper để hiển thị
//nhớ chỉnh auto load trong composer.json sau đó chạy lệnh "composer dump-autoload"

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public static function menus($menus, $parent_id = 0, $char = '')//hàm hiển thị danh sách danh mục
    {
        $html ='';
        foreach ($menus as $key => $menu){
            if ($menu->parent_id == $parent_id){
                $html .= '
                <tr>
                    <td>' . $menu['id'] . '</td>
                    <td>' . $char . $menu['name'] . '</td>
                    <td>' . $menu['description'] . '</td>
                    <td>' . $menu['content'] . '</td>
                    <td>' . self::active($menu['active']) . '</td>
                    <td>' . $menu['updated_at'] . '</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/menus/edit/' .$menu['id']. '">
                            <i class="fas fa-edit" style="color: #344379;"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="#"
                           onclick="removeRow('.$menu->id.',\'/admin/menus/destroy\')">
                           <i class="fas fa-trash-alt"></i>
                         </a>
                    </td>
                </tr>
                ';
                unset($menus[$key]);
                $html .= self::menus($menus, $menu->id, $char .'--');
            }
        }

        return $html;
    }


    public static function active($active = 0)//hiển thị nút active YES hoặc NO
    {
        return $active == 0 ? '<span class="btn btn-danger btn-xs">NO</span>' : '<span class="btn btn-success btn-xs">YES</span>';
    }

    public static function available($active = 0)//hiển thị tình trạng hàng
    {
        return $active == 0 ? '<span>Hết Hàng</span>' : '<span>Còn hàng</span>';
    }

    // hàm hiển thị danh mục ở menu trang main, dùng đệ quy để hiện thi các danh mục con
    // 2 tham số, tham số đầu là biến chứa danh sách được lấy ra từ csdl, tham số 2 là để biểu diễn danh mục cha
    public static function menu($menu, $parent_id = 0)
    {
        $html ='';
        foreach($menu as $key => $item)
        {
            if($item->parent_id == $parent_id){
                $html .= '
                    <li>
                        <a href="/category/'.$item->id.'">
                            '.$item->name.'
                        </a>';
                unset($menu[$key]);
                if(self::isChild($menu, $item->id)){ //nếu hàm isChild là true thì thêm menu con <ul></ul>
                    $html .='<ul>';
                    $html .= self::menu($menu, $item->id);// gọi lại hàm và truyền vào cả mảng như tham số đầu và id của phần tử hiện tại
                    $html .='</ul>';
                }
                  $html .='</li>
                ';
            }
        }
        return $html;
    }

    // hàm kiểm tra có danh mục con không
    public static function isChild($menu, $id)
    {
        foreach($menu as $menus){
            if($menus->parent_id == $id){ // nếu parent_id = với id
                return true;
            }
        }
        return false;
    }
}
