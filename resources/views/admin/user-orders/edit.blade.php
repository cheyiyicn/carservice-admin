<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">调整订单</h3>
    </div>
    <div class="box-body">
        <form action="{{ admin_url('user-orders') }}/{{ $order['id'] }}" method="post" class="" role="form" pjax-container>
            <div class="form-group">
                <label>订单号</label>
                <input type="text" class="form-control" value="{{ $order['order_number'] }}" disabled />
            </div>
            <div class="form-group">
                <label>车主名</label>
                <input type="text" class="form-control" value="{{ $carOwnerInfo['name'] }}" disabled />
            </div>
            <div class="form-group">
                <label>车主手机号</label>
                <input type="text" class="form-control" value="{{ $carOwnerInfo['phone_number'] }}" disabled />
            </div>
            <div class="form-group">
                <label>车主地址</label>
                <input type="text" class="form-control" value="{{ $carOwnerInfo['multilevel_address'] }} > {{ $carOwnerInfo['full_address'] }}" disabled />
            </div>
            <div class="form-group">
                <label>车主车辆信息</label>
                <div class="row">
                    <div class="col-xs-6">
                        <input type="text" class="form-control" value="{{ $carBrand['brand_name'] }}" disabled />
                    </div>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" value="{{ $carSeries['series_name'] }}" disabled />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>订单状态:</label>
            </div>
            <blockquote class="quote-primary">
                {{ $orderStatus }}
            </blockquote>
            <div class="form-group">
                <label>安装需求</label>
                <textarea name="" id="" cols="30" rows="3" class="form-control" disabled>{{ $order['comment'] }}</textarea>
            </div>
            <div class="form-group">
                <label>分配用户附近的门店</label>
                <select class="form-control">
                    @foreach ($partnerStores as $store)
                        <option id="{{ $store->id }}">{{ $store->title }}</option>
                    @endforeach
                </select>
            </div>
            @if ($installable)
                <div class="form-group">
                    <label>分配安装人员姓名</label>
                    <input type="text" name="" id="" class="form-control" />
                </div>
                <div class="form-group">
                    <label>分配安装人员手机号</label>
                    <input type="text" name="" id="" class="form-control" />
                </div>
            @endif
            <div class="form-group">
                <label style="color: red">服务金额</label>
                <input type="number" class="form-control" value="{{ $order['act_amount'] }}" required />
                <span class="help-block">
                    <i class="fa fa-info-circle"></i>&nbsp;
                    <span style="color: orange">
                        更新服务金额
                    </span>
                </span>
            </div>
            <input type="hidden" name="_method" value="PUT" class="_method">
            <div class="btn-group pull-left">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </form>
        {{ $order['id'] }}
    </div>
</div>
<script type="">
</script>