<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;
use App\Common\AjaxPage;
use Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class ArticleController extends Controller
{
    public function show($id,Request $request)
    {
        $article = Article::find($id);
        
        /*$comments = Comment::where(['article_id'=>$article->id,'type'=>1])->paginate(2);
        foreach($comments as &$value){
            $children = Comment::where(['parentId'=>$value->id])->limit(2)->get();
            if($children){
                $value->children = $children;
            }
        }*/
        
        $perPage = 2;
        if ($request->has('page')) {
            $current_page = $request->input('page');
            $current_page = $current_page <= 0 ? 1 :$current_page;
        } else {
            $current_page = 1;
        }
        
        $item = Comment::where(['article_id'=>$article->id,'type'=>1])->offset(($current_page-1)*$perPage)->limit($perPage)->get();
        $total = Comment::where(['article_id'=>$article->id,'type'=>1])->count();
        
        $comments =new LengthAwarePaginator($item, $total, $perPage, $current_page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        
        foreach($comments as &$value){
            $children_where = array(
                'parentId'=>$value->id
            );
            
            $children = Comment::where(['parentId'=>$value->id])->limit(2)->get();
            if(!$children->isEmpty()){
                $value->children = $children;
                $value->childrenpage = AjaxPage::ajaxPage('App\Models\Comment',$children_where,1);
            }
            //var_dump($value->children);die;
        }
        
        return view('article/show', compact('comments','article','id'));
        
        //自定义分页模块
        //@include('common.pagination', ['paginator' => $comments])
        
        //return view('article/show')->withArticle(Article::with('hasManyComments')->find($id));
    }
    
    public function ajaxpage(Request $request){
        $current_page = $request->input('current_page');
        $page = $request->input('page');
        $parent_id = $request->input('parent_id');
        
        if($current_page == $page){
            return '';
        }
        
        $children_where = array(
            'parentId'=>$parent_id
        );
        $children = AjaxPage::ajaxPage('App\Models\Comment',$children_where,$page);
        
        return Response::json($children);
    }
    
    public function ajaxmore(Request $request){
        $p_id = $request->input('p_id');
        $parentId = $request->input('parentId');
        $page = 2;
        $commentStr = '';
        
        for($i = 0;$i < $page;$i++){
            $result = Comment::where(['parentId'=>$parentId,'id'=>$p_id])->first();
            
            $commentStr = $result->parentContent.$commentStr;
            $p_id = $result->p_id;
        }
        
        return Response::json(['commentStr'=>$commentStr,'p_id'=>$p_id]);
    }
}
