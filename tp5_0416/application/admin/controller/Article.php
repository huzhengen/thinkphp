<?php 
namespace app\admin\controller;
use think\Controller;

class Article extends Basic {
	public function lists(){
		if(request()->isPost()){
			//导入数据里面有回收站的，但是没有在回收站里，现在把那些统一到回收站里面。
			$dels = \think\Db::name('order')->where('xx', 0)->order('id', 'desc')->count();
			dump($dels);
			$data = [
				'del' => 1,
			];
			$res = \think\Db::name('order')->where('xx', 0)->update($data);
			dump($res);
			if($res){
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
		}
		$articleres = \think\Db::name('article')->paginate('11');
		$this->assign('articleres', $articleres);
		return $this->fetch();
	}

	public function add(){
		if(request()->isPost()){
			$data = [
				'title' => input('title'),
				'keywords' => input('keywords'),
				'desc' => input('desc'),
				'content' => input('content'),
				'time' => time()
			];
			// 判断表单是否上传了文件
			if($_FILES['pic']['tmp_name']){
				//获取表单上传的文件
				$file = request()->file('pic');
				//移动到框架应用根目录/public/uploads/目录下
				$info = $file->move(ROOT_PATH . 'public' . DS . '/static/uploads');
				if($info){
					$data['pic'] = '/static/uploads' . '/' . date('Ymd') . '/' . $info->getFilename();
				}else{
					return $this->error($file->getError());
				}
			}
			// 对输入的内容进行验证，使用tp5推荐的验证器的方式
			$validate = \think\Loader::validate('Article');
			if($validate->check($data)){
				$res = \think\Db::name('article')->insert($data);
				if($res){
					return $this->success('增加文章成功');
				}else{
					return $this->error('增加文章失败');
				}
			}else{
				return $this->error($validate->getError());
			}
			return;
		}
		return $this->fetch();
	}

	public function edit(){
		$id = input('id');
		$articleres = db('article')->where('ID', $id)->find();
		$this->assign('articleres', $articleres);
		if(request()->isPost()){
			$data = [
				'ID'=>input('id'),
				'title'=>input('title'),
			];
			$validate = \think\Loader::validate('article');
			if($validate->check($data)){
				$res = \think\Db::name('article')->update($data);
				if($res){
					$this->success('修改文章成功', 'lists');
				}else{
					$this->error('修改文章失败');
				}
			}
		}
		return $this->fetch();
	}

	public function del(){
		$id = input('id');
		if(db('article')->delete($id)){
			return $this->success('删除文章成功', 'lists');
		}else{
			return $this->error('删除文章失败');
		}
		return $this->fetch();
	}
}