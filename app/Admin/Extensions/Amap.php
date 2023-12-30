<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class Amap extends Field
{
    protected $view = "admin.amap";

    protected $column = [];

    public function __construct($column, $arguments)
    {
        $this->column['lat'] = (string)$column;
        $this->column['lng'] = (string)$arguments[0];
        array_shift($arguments);
        $this->label = $this->formatLabel($arguments);
        $this->id    = $this->formatId($this->column);
    }

    public function render()
    {
        $this->script = $this->renderScript($this->id);

        // return parent::render();
        return parent::fieldRender();
    }

    public static function getAssets()
    {
        // todo: not public, need move in the config file.
        $mapApiKey = 'e8f05960883dbd922965622f11d0f6a5';
        $mapJs = sprintf('https://webapi.amap.com/maps?v=1.4.12&key=%s', $mapApiKey);

        return ['js' => $mapJs];
    }

    private function renderScript($id_set) {
        return <<<EOT
(function() {
    function init() {
        // 加载同时创建 input 框
        const tipinputEl = $("#tipinput");
        const fullAddress = $("#full_address");
        var lat = $("#{$id_set['lat']}");
        var lng = $("#{$id_set['lng']}");

        var map = new AMap.Map("container", {
            zoom: 11,
            viewMode:'3D',
        });

        var marker = new AMap.Marker({
            map: map,
            draggable: true,
            position: [lng.val() || 0, lat.val() || 0],
        })

        marker.on('dragend', function (e) {
            lat.val(e.lnglat.getLat());
            lng.val(e.lnglat.getLng());
        });

        map.on('click', function(e) {
            marker.setPosition(e.lnglat);
            lat.val(e.lnglat.getLat());
            lng.val(e.lnglat.getLng());
        });

        AMap.plugin(['AMap.Autocomplete', 'AMap.PlaceSearch', 'AMap.Geocoder'], function(){
            // 选项
            const autoOptions = {
                input: "tipinput",
            };
            // 构造完成类
            var autocomplete = new AMap.Autocomplete(autoOptions);
            console.log(autocomplete);
            // 构造地点查询类
            var placeSearch = new AMap.PlaceSearch({
                map: map
            });
            // 注册监听，当选中某条记录时会触发
            function select(e) {
                console.log(e.poi.district + e.poi.address + e.poi.name)
                fullAddress.val(e.poi.district + e.poi.address + e.poi.name);
                placeSearch.setCity(e.poi.adcode);
                placeSearch.search(e.poi.name);  //关键字查询查询
            }
            let a = AMap.event.addListener(autocomplete, "select", select);
        })
    }

    init();
})()
EOT;
    }
}
