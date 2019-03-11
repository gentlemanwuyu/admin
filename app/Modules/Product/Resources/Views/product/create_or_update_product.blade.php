@extends('layouts.template')
@section('css')
    <style>
        img {
            width: auto;
            height: 200px;
        }
        .img_container {
            width: 212px;
            /*height: 212px;*/
            border: 1px solid #3c8dbc;
            padding: 5px;
            border-radius: 3px;
            display: inline-block;
        }
    </style>
@endsection
@section('body')
    <form class="form-horizontal">
        <div class="row" style="padding: 30px;">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h5 class="box-title">@lang('product::product.base_info')</h5>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-2" style="text-align: center">
                            <div class="img_container">
                                {{--<img src="/assets/img/system/none.jpg" alt="">--}}
                                <img src="https://www.gravatar.com/avatar/e7f04fb1d406bc12f3d8bece06e59d11.jpg?s=80&d=mm&r=g" alt="">
                            </div>
                            <div class="form-group" style="margin-top: 15px;">
                                <input type="file">
                            </div>
                        </div>
                        <div class="col-xs-4 col-xs-offset-1">
                            <div class="form-group">
                                <label class="col-xs-3 control-label required">@lang('product::product.product_code')</label>
                                <div class="col-xs-9">
                                    <input type="text" name="code" class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label required">@lang('product::product.product_name')</label>
                                <div class="col-xs-9">
                                    <input type="text" name="name" class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label required">@lang('application.description')</label>
                                <div class="col-xs-9">
                                    <textarea class="form-control" name="description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label required">@lang('product::product.category')</label>
                                <div class="col-xs-9">
                                    <select name="category_id" class="form-control select2">
                                        <option value="">@lang('product::product.please_select_category')</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->display_name}}</option>
                                            @if(isset($category->children) && $category->children)
                                                @foreach($category->children as $son)
                                                    <option value="{{$son->id}}">{{str_repeat('&nbsp;', 4)}}{{$son->display_name}}</option>
                                                    @if(isset($son->children) && $son->children)
                                                        @foreach($son->children as $grandson)
                                                            <option value="{{$grandson->id}}">{{str_repeat('&nbsp;', 8)}}{{$grandson->display_name}}</option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h5 class="box-title">@lang('product::product.product_attribute')</h5>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-xs-6">
                        <table class="table table-hover">
                            <tr>
                                <th>@lang('application.index_number')</th>
                                <th>@lang('product::product.attribute_name')</th>
                                <th>@lang('product::product.is_required')</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>外径</td>
                                <td><input type="checkbox" class="minimal" name="is_leader" value="1"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>内孔</td>
                                <td><input type="checkbox" class="minimal" name="is_leader" value="1"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>长度</td>
                                <td><input type="checkbox" class="minimal" name="is_leader" value="1"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix no-border">
                    <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('product::product.add_attribute')</button>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h5 class="box-title">@lang('product::product.sku_list')</h5>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>@lang('application.index_number')</th>
                            <th class="required">@lang('product::product.sku_code')</th>
                            <th>@lang('product::product.weight')</th>
                            <th class="required">@lang('product::product.cost_price')</th>
                            <th>外径</th>
                            <th>内孔</th>
                            <th>长度</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon">g</span>
                                </div>
                            </td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon">g</span>
                                </div>
                            </td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon">g</span>
                                </div>
                            </td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon">g</span>
                                </div>
                            </td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="" class="form-control">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="box-footer clearfix no-border">
                    <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('product::product.add_sku')</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        $(function () {
            var upload_layer_index;
            $('input:file').fileinput({
                showPreview: false,
                uploadUrl: "{{route('product::product.upload')}}",
                layoutTemplates: {progress: ''},
                removeLabel: '',
                uploadLabel: '',
                browseLabel: ''
            });
            $('input:file').on('filepreupload', function () {
                upload_layer_index = layer.load();
            });
            $('input:file').on('fileuploaded', function (event, data, previewId, index) {
                layer.close(upload_layer_index);
                var response = data.response;
                $('img').attr('src', response);
                $('div.kv-upload-progress').hide();
            });
        });
    </script>
@endsection