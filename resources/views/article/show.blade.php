@extends('layouts.app')

@section('content')

    <div id="content" style="padding: 50px;">

        <h4>
            <a href="/home"><< 返回首页</a>
        </h4>

        <h1 style="text-align: center; margin-top: 50px;">{{ $article->title }}</h1>
        <hr>
        <div id="date" style="text-align: right;">
            {{ $article->updated_at }}
        </div>
        <div id="content" style="margin: 20px;">
            <p>
                {{ $article->body }}
            </p>
        </div>

        <div id="comments" style="margin-top: 50px;">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>操作失败</strong> 输入不符合要求<br><br>
                    {!! implode('<br>', $errors->all()) !!}
                </div>
            @endif

            <div id="new">
                <form action="{{ url('comment') }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <input type="hidden" name="nickname" value="{{ Cookie::get('nk') }}">
                    <input type="hidden" name="user_id" value="{{ Cookie::get('uid') }}">
                    <input type="hidden" name="type" value="1">
                    
                    <div class="form-group">
                        <label>内容</label>
                        <textarea name="content" id="newFormContent" class="form-control" rows="10" required="required"></textarea>
                    </div>
                    <button type="submit" class="btn btn-lg btn-success col-lg-12">提交</button>
                </form>
            </div>

            <div class="conmments" style="margin-top: 100px;">
                @foreach ($comments as $comment)
                <div id="commentdiv">
                    <div class="one" style="border-top: solid 20px #efefef; padding: 5px 10px;" prentId="{{ $comment->id }}" id="{{ $comment->id }}">
                        <div class="nickname" data="{{ $comment->nickname }}">
                            
                            <h3>{{ $comment->nickname }}</h3>
                            
                            <h6>{{ $comment->created_at }}</h6>
                        </div>
                        <div class="content">
                            <p style="padding: 20px;">
                                <span>{{ $comment->content }}</span>
                            </p>
                        </div>
                        <div class="reply" style="text-align: right; padding: 5px;">
                            <a href="javascript:void(0)" onclick="reply(this);" check="none">回复</a>
                        </div>
                    </div>
                    
                    @if ($comment->children)
                        <div id='children_div'>
                        @foreach ($comment->children as $com)
                            <div class="one" style="border-top: solid 20px #efefef; padding: 5px 50px;" prentId="{{ $com->parentId }}" id="{{ $com->id }}">
                                <div class="nickname" data="{{ $com->nickname }}">
                                    
                                    <h3>{{ $com->nickname }}</h3>
                                    
                                    <h6>{{ $com->created_at }}</h6>
                                </div>
                                <div class="content">
                                    <p style="padding: 20px;">
                                        <a href="javascript:void(0)" onclick="load_more(this)" p_id="{{ $com->p_id }}">查看更多</a>{{ $com->parentContent }}<span>{{ $com->content }}</span>
                                    </p>
                                </div>
                                <div class="reply" style="text-align: right; padding: 5px;">
                                    <a href="javascript:void(0)" onclick="reply(this);">回复</a>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        @include('common.ajaxpage', ['page' => $comment->childrenpage])
                    @endif
                   </div>
                @endforeach
            
            {{ $comments->links() }}
            
            </div>
        </div>

    </div>
@endsection

<script>
    //回复
    function reply(a) {
        
        var parentNickname = $(a).parents('.one').find('.nickname').attr('data');
        var parentContent = $(a).parents('.one').find('.content p span').text();
        var parentId = $(a).parents('.one').attr('prentId');
        var p_id = $(a).parents('.one').attr('id');
    
        var action = "{{ url('comment') }}";
        var csrf_field = '{!! csrf_field() !!}';
        var article_id = "{{ $article->id }}";
        var nickname = "{{ Cookie::get('nk') }}";
        var user_id = "{{ Cookie::get('uid') }}";
        var afterHtml = '<form action="'+action+'" method="POST" id="children_form">'+csrf_field+
        '<input type="hidden" name="article_id" value="'+article_id+'">'+
        '<input type="hidden" name="nickname" value="'+nickname+'">'+
        '<input type="hidden" name="user_id" value="'+user_id+'">'+
        '<input type="hidden" name="type" value="2">'+
        '<input type="hidden" name="parentId" value="'+parentId+'">'+
        '<input type="hidden" name="p_id" value="'+p_id+'">'+
        '<input type="hidden" name="parentContent" value="@'+parentNickname+': '+parentContent+' || ">'+
        '<div class="form-group">'+
            '<label>Content</label>'+
            '<textarea name="content" id="childrenNewFormContent" class="form-control" rows="5" required="required" placeholder="@'+parentNickname+'"></textarea>'+
        '</div>'+
        '<button type="submit" class="btn btn-lg btn-success col-lg-12">Submit</button>'+
    '</form>';
        $(a).parent().after(afterHtml);
    }

    //分页
	function page(a,p){
	    var page_id = $(a).parent().attr('page_id');
	    var childrenObj = $(a).parents('#commentdiv').find('#children_div');
	    var parent_id = $(a).parents('#commentdiv').find('.one:first').attr('id');
	    
	    $.ajax({
    	   dataType:'json',
    	   type: 'get',
    	   url: '{{$id}}/ajaxpage',
    	   data: {'current_page':page_id,'page':p,'parent_id':parent_id},
    	   success:function(res){
    		   //console.log(res);
    		   
    		   //删除当前
    		   childrenObj.empty();
    		   
    		   var childrenHtml = '';
    		   for(var i = 0;i < res.data.length;i++){
    			   childrenHtml += '<div class="one" style="border-top: solid 20px #efefef; padding: 5px 50px;" prentId="'+res.data[i].parentId+'" id="'+res.data[i].id+'">'+
                               '<div class="nickname" data="'+res.data[i].nickname+'">'+
                           '<h3>'+res.data[i].nickname+'</h3>'+
                           '<h6>'+res.data[i].created_at+'</h6>'+
                       '</div>'+
                       '<div class="content">'+
                           '<p style="padding: 20px;">'+
                               '<a href="javascript:void(0)" onclick="load_more(this)" p_id="'+res.data[i].p_id+'">查看更多</a>'+res.data[i].parentContent+'<span>'+res.data[i].content+'</span>'+
                           '</p>'+
                       '</div>'+
                       '<div class="reply" style="text-align: right; padding: 5px;">'+
                           '<a href="javascript:void(0)" onclick="reply(this);">回复</a>'+
                       '</div>'+
                   '</div>';
    		   }
    		   
    		   childrenObj.append(childrenHtml);
    		   $(a).parent().attr('page_id',res.page);
    	   }
    	});
	}

	//加载更多
	function load_more(o){
	    var p_id = $(o).attr("p_id");
	    var parentId = $(o).parents('.one').attr('prentId');

	    $.ajax({
	    	   dataType:'json',
	    	   type: 'get',
	    	   url: '{{$id}}/ajaxmore',
	    	   data: {'p_id':p_id,'parentId':parentId},
	    	   success:function(res){
	    		   //console.log(res);
	    		   
	    		   $(o).after(res.commentStr);
	    		   $(o).attr("p_id",res.p_id);
	    	   }
    	});
	}
</script>