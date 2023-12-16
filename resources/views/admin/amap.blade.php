<div class="form-group">
    <label for="" class="{{$viewClass['label']}} control-label">{{$label}}</label>
    <div class="{{$viewClass['field']}}">
        <input hidden id="{{$id['lng']}}" name="{{$id['lng']}}" value="0" />
        <input hidden id="{{$id['lat']}}" name="{{$id['lat']}}" value="0" />
        <div><input id="tipinput" /></div>
        <div id="container" style="width: 100%; height: 500px"></div>
    </div>
</div>