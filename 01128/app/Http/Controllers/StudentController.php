<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
// 接值Input
use Illuminate\Support\Facades\Input;
//DB//sql
use Illuminate\Support\Facades\DB;
//session  request实例
use Illuminate\Http\Request;
//引用dfa自动过滤词
use Sensitive;
//引用redis
//use Redis;
use Illuminate\Support\Facades\Redis;  
class StudentController extends Controller{

 //登录页面
 public function login()
 {

 	if(Input::all())
 	{  
 	   //接值（单个）
       $username = Input::get('username');
       $password = Input::get('password');
       //接值（所有）
       $input = Input::all();
       //查询数据库
       $res=DB::select("select * from user where username = '$username' and password=".$password);
       if($res)
       {
       	 //存储一个session
        session(['key' =>$username]);
       	echo "<script>alert('登陆成功'),location.href='index'</script>";


       }
       else
       {
       	echo "<script>alert('账号或密码错误'),location.href='login'</script>";die;
       }
 	}
 	else
 	{
 		 return view('student/login');
 	}
  
 }
  
  //展示页面
  public function index()
  {

    $value = session('key');
    //查询数据库
    $res=DB::select("select * from liuyan");
    $res=DB::table('liuyan')->get();
    return view('student/index',['res'=>$res,'value'=>$value]);

  }
  
  // ajax添加
   public function add()
   {
   	 //登录存储的session
     $value = session('key'); 

   	  $post=Input::all();
      unset($post['_token']);

     //dfa过滤
   	 $interference = ['&', '*'];
   	 $filename = 'D:\phpstudy\WWW\WAMP\01128\app\Http\Controllers\words.txt'; //每个敏感词独占一行
     Sensitive::interference($interference); //添加干扰因子
     Sensitive::addwords($filename); //需要过滤的敏感词
     $txt = $post['content'];
     $post['content'] = Sensitive::filter($txt);
     $txt1 = $post['title'];
     $post['title'] = Sensitive::filter($txt1);
     $post['username']=$value;
     $post['add_time']=strtotime($post['add_time']);

      $res = DB::table('liuyan')->insert($post);
      if($res)
      { 
        //开启redis
      	$redis = app('redis.connection');

      	$mkv=array
      	(
          'username'=>$post['username'],
          'title'=>$post['title'],
          'content'=>$post['content'],
          'add_time'=> $post['add_time']

      	);
      	
      	$redis->mset($mkv); // 存储 key 为 library， 值为 predis 的记录；
      	$res=$redis->mget(array_keys($mkv));

      	echo 1;
     

      }
      else
      {
      	echo 0;
      }
   }
   //ajax删除
   public function delete()
   { 
   	 //接id
     $id=input::get('id');
     $res=DB::table('liuyan')->where('id','=',$id)->delete();
     if($res)
     {
     	echo 1;
     }
   }
   //修改默认
   public function update()
   {
   		$res=DB::table('liuyan')->where('id','=',Input::get('id'))->first();
   		return view('student/update',['res'=>$res]);
   }
   //修改
   public function up()
   {   
   	   //登录存储的session
       $value = session('key'); 
       
       $post=Input::all();
       $post['username']=$value;
       unset($post['_token']);
       $res=DB::table('liuyan')->where('id',$post['id'])->update($post);
       if($res)
       {
       	echo "<script>alert('修改成功'),location.href='index'</script>";
       }

   }
   public function rediss()
   { 
     $redis = app('redis.connection');
     $redis->set('library', 'predis1111'); // 存储 key 为 library， 值为 predis 的记录；
      // 获取 key 为 library 的记录值
     print_r($redis->get('library'));die;
   }
}































































































































































//普通添加
  // public function add()
  // {
  //  if(input::get('title'))
  //  {
  //     //接所有值
  //     $post=Input::all();
  //     unset($post['_token']);
  //     print_r($data);die;
  //     $res = DB::table('liuyan')->insert($post);
  //     if($res)
  //     {
  //     	echo "<script>alert('添加成功'),location.href='index'</script>";
  //     }
  //  }
  //  else
  //  { 
  //  	return view('student/add');
  //  }

  // }