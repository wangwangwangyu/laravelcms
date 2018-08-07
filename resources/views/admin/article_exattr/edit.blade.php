@extends("admin.include.mother")@section('content')    <div class="u-breadcrumb">        <a class="back" href="javascript:history.back()" ><span class="fa fa-chevron-left"></span> 后退</a>        <a class="back" href="javascript:window.location.reload()" ><span class="fa fa-repeat"></span> 刷新</a>        <span class="name">编辑附加字段</span>    </div>    <div class="h15"></div>    <form method="post">        <input type="hidden" value="{{$page->id}}" name="id" />        <div class="form-group">            <label><span class="text-danger">* </span>字段名称</label>            <input type="text" class="form-control w400" name="name" placeholder="字段名称" value="{{$page->name}}">            <small class="form-text text-muted">1-20个字符</small>        </div>        <div class="form-group">            <label><span class="text-danger">* </span>组件类型</label>            <select class="form-control w400" name="type" lay-filter="type">                @foreach(config('config.config_type') as $k=>$v)                    <option value="{{$k}}" @if($k == $page->type) selected @endif>{{$v}}</option>                @endforeach            </select>        </div>        <div class="form-group">            <label><span class="text-danger">* </span>键</label>            <input type="text" class="form-control w400" name="key" placeholder="键" value="{{$page->key}}">            <small class="form-text text-muted">取值的字段名</small>        </div>        <div class="form-group @if(!in_array($page->type,[3,4,5])) hide @endif js-width">            <label>宽度</label>            <input type="text" class="form-control w400" name="width" placeholder="宽度" value="{{$page->width}}">            <small class="form-text text-muted">图片的宽度，0或空值表示不限制</small>        </div>        <div class="form-group @if(!in_array($page->type,[3,4,5])) hide @endif js-height">            <label>高度</label>            <input type="text" class="form-control w400" name="height" placeholder="高度" value="{{$page->height}}">            <small class="form-text text-muted">图片的高度，0或空值表示不限制</small>        </div>        <div class="form-group @if(!in_array($page->type,[3,4])) hide @endif js-size">            <label>图片允许大小</label>            <input type="text" class="form-control w400" name="size" placeholder="图片允许大小" value="{{$page->size}}">            <small class="form-text text-muted">单位：M，0或空值表示不限制</small>        </div>        <div class="form-group @if(!in_array($page->type,[5])) hide @endif js-custom">            <label>编辑器类型</label>            <select class="form-control w400" name="custom">                @foreach(config('config.ckeditor_custom') as $k=>$v)                    <option value="{{$k}}" @if($k == $page->custom)  @endif>{{$v}}</option>                @endforeach            </select>            <small class="form-text text-muted"></small>        </div>        <div class="form-group">            <label for="tips">小贴士</label>            <input type="text" class="form-control w400" id="tips" name="tips" placeholder="小贴士" value="{{$page->tips}}">            <small class="form-text text-muted">字段的说明</small>        </div>        <div class="form-group">            <label for="sort"><span class="text-danger">* </span>排序</label>            <input type="text" class="form-control w400" id="sort" name="sort" placeholder="排序" value="{{$page->sort}}">            <small class="form-text text-muted">默认500,数值越小排名越靠前</small>        </div>        <div class="h10"></div>        <button type="submit" class="btn btn-primary" onclick="return post_edit();">保存</button>    </form>    <script>        //类型切换        $('select[name=type]').change(function(){            if($(this).val() == 3 || $(this).val() == 4){                //$('.js-value').hide().find('input[name=value]').val('');                $('.js-custom').hide();                $('.js-width').show();                $('.js-height').show();                $('.js-size').show();            }else if($(this).val() == 5){                //$('.js-value').hide().find('input[name=value]').val('');                $('.js-custom').show();                $('.js-width').show();                $('.js-height').show();                $('.js-size').hide();            }else{                //$('.js-value').show();                $('.js-custom').hide();                $('.js-width').hide().find('input[name=width]').val('');                $('.js-height').hide().find('input[name=height]').val('');                $('.js-size').hide().find('input[name=size]').val('');            }        });        //提交编辑        function post_edit(){            $.ajax({                type:'post',                url:'/admin/article_exattr/edit',                data:$('form').serialize(),                success:function(res){                    if(res.status == 0){                        $boot.warn({text:res.msg},function(){                            $('input[name='+res.field+']').focus();                        });                    }else{                        $boot.success({text:res.msg},function(){                            window.location = "/admin/article_cate/edit?id={{$page->cate_id}}&on=1";                        });                    }                }            })            return false;        }    </script>@endsection