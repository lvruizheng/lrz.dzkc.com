@if ($page)
    <div class="pagination" page_id="{{$page['page']}}">
        <a href="javascript:void(0)" onclick="page(this,1)">首页</a>
        <a href="javascript:void(0)" onclick="page(this,<?php echo $page['prev'] ?>)">上一页</a>
        <a href="javascript:void(0)" onclick="page(this,<?php echo $page['next'] ?>)">下一页</a>
        <a href="javascript:void(0)" onclick="page(this,<?php echo $page['sums'] ?>)">尾页</a><br />
        
        @foreach($page['pp'] as $key=>$val)
            @if($val == $page['page'])
                {{$val}}
            @else
                <a href="javascript:void(0)" onclick="page(this,{{$val}})">{{$val}}</a>
            @endif
        @endforeach
    </div>
@endif