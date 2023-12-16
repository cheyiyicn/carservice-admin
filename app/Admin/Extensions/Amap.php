<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class Amap extends Field
{
    protected static $api = '//webapi.amap.com/maps?v=1.4.12&key=%s';

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
        $mapApiKey = '76d95a998b37a8f18990f745eb0548a6';
        $mapJs = sprintf('https://webapi.amap.com/maps?v=1.4.12&key=%s', $mapApiKey);

        return ['js' => $mapJs];
    }

    private function renderScript($id_set) {
        return <<<EOT
(function() {
    function init() {
        var lat = $("#{$id_set['lat']}");
        var lng = $("#{$id_set['lng']}");
        var address = $("#address");
        console.log(address.val('123123123'))

        // 输入提示
        var autoOptions = {
            input: "address"
        };
        AMap.event.addListener(auto, "select", select);// 注册监听，当选中某条记录时会触发
        function select(e) {
            placeSearch.setCity(e.poi.adcode);
            placeSearch.search(e.poi.name);  //关键字查询查询
        }

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
            console.log(e, e.lnglat.getLat(), e.lnglat.getLng());
            lat.val(e.lnglat.getLat());
            lng.val(e.lnglat.getLng());
        });

        AMap.plugin('AMap.Autocomplete', function(){
            var autoOptions = {
            };
            var autocomplete= new AMap.Autocomplete(autoOptions);
            AMap.event.addListener(autocomplete, "select", function(data) {
                map.setZoomAndCenter(18, data.poi.location);
                marker.setPosition(data.poi.location);
                console.log(data.poi.location);
            })
        })
    }
    init();
})()
EOT;
    }
}
