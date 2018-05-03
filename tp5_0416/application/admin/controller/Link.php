<?php 
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Link as links;

class Link extends Basic{
	public function lists(){
	    $linkres = \think\Db::name('link')->paginate(3);
	    $this->assign('linkres', $linkres);
		return $this->fetch();
	}
	public function add(){
	    if(request()->isPost()){
	        $data = [
	            'title'=>input('title'),
                'url'=>input('url'),
                'desc'=>input('desc'),
            ];
	        $validate = \think\Loader::validate('Link');
	        if($validate->check($data)){
	            $res = \think\Db::name('link')->insert($data);
	            if($res){
	                return $this->success('添加友情链接成功');
                }else{
	                return $this->error('添加友情链接失败');
                }
            }else{
	            return $this->error($validate->getError());
            }
            return;
        }
		return $this->fetch();
	}
	public function edit(){
		$links = db('link')->where('id', input('id'))->find();
		$this->assign('links', $links);
		//修改后提交
		if(request()->isPost()){
			$data = input('post.');
			$validate = \think\Loader::validate('Link');
			if($validate->check($data)){
				$res = \think\Db::name('link')->update($data);
				if($res){
					return $this->success('修改友情链接成功', 'lists');
				}else{
					return $this->error('修改友情链接失败');
				}
			}else{
				return $this->error($validate->getEror());
			}
		}
		return $this->fetch();
	}
	public function del(){
		$id = input('id');
		if(db('link')->delete($id)){
			return $this->success('删除友情链接成功', 'lists');
		}else{
			return $this->error('删除友情链接失败');
		}
	}
}

