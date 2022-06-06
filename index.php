<?php
include_once 'public/config_file.php';
$navnum = '1';
$modelImg = $db->select("bgpic","bgid=1");
if(!empty($_POST['mode'])){
	$leixingid=$_POST['mode'];
	$leixingidsql="and leixing='$leixingid'";
}else{
    $leixingid="";
	$oneclassidsql=""; 
};
if(!empty($_POST['leixing'])){
	$fuleixingid=$_POST['leixing'];
	$fuleixingidsql="and fuleixing='$fuleixingid'";
}else{
    $fuleixingid="";
	$fuleixingidsql=""; 
};
if(!empty($_POST['fuleixing'])){
	$threeleixingid=$_POST['fuleixing'];
	$threeleixingidsql="and threeleixing='$threeleixingid'";
}else{
    $threeleixingid="";
	$threeleixingidsql=""; 
};
if(!empty($_POST['mianshu'])){
	$mianshuid=$_POST['mianshu'];
	$mianshuidsql="and mianshu='$mianshuid'";
}else{
    $mianshuid="";
	$mianshuidsql=""; 
};
if(!empty($_POST['buxian'])){
	$buxianid=$_POST['buxian'];
	$buxianidsql="and buxian='$buxianid'";
}else{
    $buxianid="";
	$buxianidsql=""; 
};
if(!empty($_POST['geshi'])){
	$geshiid=$_POST['geshi'];
	$geshiidsql="and geshi='$geshiid'";
}else{
    $geshiid="";
	$geshiidsql=""; 
};
if(!empty($_POST['shaixuan'])){
	$shaixuanid=$_POST['shaixuan'];
	$shaixuanidsql="and shaixuan='$shaixuanid'";
}else{
    $shaixuanid="";
	$shaixuanidsql=""; 
};
if(!empty($_POST['px'])){
	if($_POST['px'] == "zuixin"){
		$px = "istuijian desc,dates desc";
	}
	if($_POST['px'] == "jiage"){
		$px = "istuijian desc,money desc";
	}
	if($_POST['px'] == "remen"){
		$px = "istuijian desc,click desc";
	}
	if($_POST['px'] == "xiazai"){
		$px = "istuijian desc,xiazai desc";
	}
}else{
	$px = "istuijian desc,dates desc,money desc,click desc,xiazai desc";
};
$db -> select("usmodel", "isok=3 $leixingidsql $fuleixingidsql $threeleixingidsql $mianshuidsql $buxianidsql $geshiidsql $shaixuanidsql","","$px");
$total = $db -> rowCount;
//实例化分页类
$pageSize = 9;
$page = new Page($total, $pageSize);
//分页显示效果
$pageStr = $page -> pages();
$offset = ($page -> curPage - 1) * $pageSize;
$limit = $offset . "," . $pageSize;
$model = $db -> select("usmodel", "isok=3 $leixingidsql $fuleixingidsql $threeleixingidsql $mianshuidsql $buxianidsql $geshiidsql $shaixuanidsql", "$limit", "$px");
// echo $db->getSql();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"> -->
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"> -->
	<!-- <meta name="viewport" content="initial-scale=1,maximum-scale=1, minimum-scale=1, user-scalable=no"> -->
	<!-- 禁止移动端缩放 -->
	<meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="format-detection" content="email=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- ios7.0版本以后，safari上已看不到效果将网站添加到主屏幕快速启动方式，仅针对ios的safari顶端状态条的样式 -->
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<!-- 可选default、black、black-translucent -->
	<link rel="stylesheet" href="/m/css/bootstrap.min.css">
	<script src="/m/js/jquery-3.4.1.min.js"></script>
	<script src="/m/js/bootstrap.min.js"></script>
	<!--公共头尾-->
	<link rel="stylesheet" href="/m/css/public_h_f.css">
	<link rel="stylesheet" href="/m/css/index.css">
	<!-- 引入轮播插件 -->
	<link rel="stylesheet" href="/m/swiper/swiper-bundle.min.css">
	<script src="/m/swiper/swiper-bundle.min.js"></script>
	<title>量子模型网模型库—<?php echo $system[0]['sitename'] ?></title>
	<meta name="keywords" content="<?php echo $system[0]['keywords']?>">
	<meta name="Description" content="<?php echo $system[0]['description']?>">
</head>

<body>
	<!-- 头部 -->
	<div class="head_tit">
		<div class="head_tit_t">
			<span class="filt_ll" data-toggle="modal" data-target="#dia_left">
				<img src="/m/img/tit_l.png" alt="导航">
			</span>
		</div>
		<div class="head_tit_m">
			<a href="/m/">
				<img src="/m/img/log_tit.png" alt="量子模型网">
			</a>
		</div>
		<div class="head_tit_b">
			<span class="filtt">
				<span class="filt_r" data-toggle="modal" data-target="#dia_right">筛选</span>
			</span>
		</div>
	</div>
	<!-- 轮播图 -->
	<div class="swiper-container wrap1">
		<div class="swiper-wrapper wrap2">
			<?php foreach ($modelImg as $k=>$v) :?>
				<div class="swiper-slide">
					<a href="<?php echo $modelImg[$k]['ydpicsrcurl'];?>" style="background: url(<?php echo $modelImg[$k]['picsrc'];?>) no-repeat center center;background-size: cover;">	
					</a>
				</div>
			<?php endforeach; ?>
			<!-- <div class="swiper-slide">
				<a href="">
					
				</a>
			</div> -->
		</div>
		<!-- 如果需要分页器 -->
		<div class="swiper-pagination wrap_swp"></div>
	</div>
	<!-- 内容区 -->
	<div class="cont">
		
		<form name="myform" method="post" action="/m/search-model.php"  enctype="multipart/form-data">
			<div class="inp">
				<img src="/m/img/seach.png">
				<input type="text" name="seachmtext"  class="form-control" id="inputPassword" placeholder="搜索你想要的模型">
				<input type="submit" value="搜索">
			</div>
		</form>
		<div class="show_tit">
			<div></div>
			<div>精品模型</div>
			<div></div>
		</div>
		<!-- 展示内容 -->
		<div class="show_con">
			<?php foreach ($model as $k=>$v) :?>
				<div class="show_con_box">
					<div class="show_con_box_t">
						<div>
							<a href="model_details.php?id=<?php echo $model[$k]['id']; ?>"><img src="<?php echo $model[$k]['picsrc']; ?>" alt="<?php echo $model[$k]['title']; ?>"></a>
						</div>
					</div>
					<div class="show_con_box_b">
						<div>
							<a href="model_details.php?id=<?php echo $model[$k]['id']; ?>"><?php echo mb_strlen($model[$k]['title'],'utf-8')>10 ? mb_substr($model[$k]['title'],0,11,'utf-8').'...' : $v['title'];?></a>
						</div>
						<div class="show_bot">
							<div>
								<span><img src="/m/img/eye1.png" alt=""></span>
								<span><?php echo $model[$k]['click']; ?></span>
							</div>
							<div>
								<span><img src="/m/img/head1.png" alt=""></span>
								<span><?php echo $model[$k]['dianzan']; ?></span>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="page_f">
		<nav aria-label="Page navigation">
			<ul class="pagination">
				<?php echo $pageStr; ?>
			</ul>
		</nav>
	</div>
	<!-- 优秀设计师 -->
	<div class="show_tit">
		<div></div>
		<div>优秀设计师</div>
		<div></div>
	</div>
	<div class="stylist_show">
		<div class="stylist_c">
			<a href="javascript:void(0);">
				<div class="cont_on">
					<div class="cont_img">
						<img src="../img/memb_lImg.jpg" alt="量子签约模型师浪客虾米">
					</div>
					<div class="cont_we">浪客虾米</div>
					<div class="cont_js">技术宅，3D模型师</div>
				</div>
				<div class="stylist_text">在工作中从完善到创新，是自己的价值，是自己进步的过程，是说明自己有信心，有能力迎接挑战的勇气。</div>
			</a>
		</div>
		<div class="stylist_c">
			<a href="javascript:void(0);">
				<div class="cont_on">
					<div class="cont_img">
						<img src="../img/memb_lImg2.jpg" alt="量子签约模型师爱拼才会赢">
					</div>
					<div class="cont_we">爱拼才会赢</div>
					<div class="cont_js">游戏美术，模型师</div>
				</div>
				<div class="stylist_text">尽职尽责地去完成，才有可能将工作目标完成得尽善尽美无论是阅读东西，还是学东西。</div>
			</a>
		</div>
		<div class="stylist_c">
			<a href="javascript:void(0);">
				<div class="cont_on">
					<div class="cont_img">
						<img src="../img/memb_lImg3.jpg" alt="量子签约模型师匿名者">
					</div>
					<div class="cont_we">匿名者</div>
					<div class="cont_js">模型师，全职高手</div>
				</div>
				<div class="stylist_text">既异想天开，又实事求是，这是科学工作者特有的风格，让我们在无穷的宇宙长河中探求无穷的真理吧。</div>
			</a>
		</div>
		<div class="stylist_c">
			<a href="javascript:void(0);">
				<div class="cont_on">
					<div class="cont_img">
						<img src="../img/memb_lImg4.jpg" alt="量子签约模型师小笨笨">
					</div>
					<div class="cont_we">小笨笨</div>
					<div class="cont_js">动画，技术宅</div>
				</div>
				<div class="stylist_text">没有人富有得可以不要别人的帮助，也没有人穷得不能在某方面给他人帮助。</div>
			</a>
		</div>
		<div class="stylist_c">
			<a href="javascript:void(0);">
				<div class="cont_on">
					<div class="cont_img">
						<img src="../img/memb_lImg5.jpg" alt="量子签约模型师老鸡抓小鹰">
					</div>
					<div class="cont_we">老鸡抓小鹰</div>
					<div class="cont_js">模型师，灯光师</div>
				</div>
				<div class="stylist_text">是自己进步的过程，是说明自己有信心，有能力迎接挑战的勇气在工作中，要学会对自己。</div>
			</a>
		</div>
		<div class="stylist_c">
			<a href="javascript:void(0);">
				<div class="cont_on">
					<div class="cont_img">
						<img src="../img/memb_lImg6.jpg" alt="量子签约模型师低调小伙">
					</div>
					<div class="cont_we">低调小伙</div>
					<div class="cont_js">技术宅，模型师，全职高手</div>
				</div>
				<div class="stylist_text">小细节往往是影响到大局和事态发展结果的关键事无巨细，都全力以赴尽职尽责地去完成，才有可能将工作目标完成得尽善尽美。</div>
			</a>
		</div>
	</div>
	<!-- 品牌合作 -->
	<div class="show_titt">
		<div></div>
		<div>品牌合作</div>
		<div></div>
	</div>
	<div class="show_log">
		<div>
			<a href="javascript:void(0);">
				<img src="../img/log1.png" alt="">
			</a>
		</div>
		<div>
			<a href="javascript:void(0);">
				<img src="../img/log2.png" alt="">
			</a>
		</div>
		<div>
			<a href="javascript:void(0);">
				<img src="../img/log3.png" alt="">
			</a>
		</div>
		<div>
			<a href="javascript:void(0);">
				<img src="../img/log4.png" alt="">
			</a>
		</div>
	</div>
	</div>
	<!-- 页面底部 -->
	<?php include_once 'footer_fb.php';?>
	<!-- 底部tab切换导航 -->
	<?php include_once 'footer_table.php';?>
	<!-- 导航栏 -->
	<?php include_once 'navigation_bar.php';?>

	
	<!-- right弹框 -->
	<div class="modal fade" id="dia_right" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header ">
					<h4 class="modal-title" id="myModalLabel">精品模型分类</h4>
					<img class="close_r close" data-dismiss="modal" aria-hidden="true" src="img/clo_1.png" alt="">
				</div>
				<form name="myform" id="myform" method="post" action="/m/index.php"  onSubmit="" enctype="multipart/form-data">
					<div class="modal-body">
						<!-- 存精品模型分类选中的值 -->
						<input type="hidden" name="mode" id="leixing" value="" />
						<input type="hidden" name="leixing" id="fuleixing" value="" />
						<input type="hidden" name="fuleixing" id="threeleixing" value="" />
						<input type="hidden" name="mianshu" id="mianshu" value="" />
						<input type="hidden" name="buxian" id="buxian" value="" />
						<input type="hidden" name="shaixuan" id="saixuan" value="" />
						<input type="hidden" name="px" id="px" value="" />
						
						<div class="dia_t">
							<div>类型</div>
							<div class="dia_t_list">
								<div class="t_list list_b" rel="" name="mode">全部</div>
								<?php $sroot_pid = $db->select("sroot","sroot_pid=1","","id asc"); foreach ($sroot_pid as $k=>$v) :?>
									<div rel="<?php echo $sroot_pid[$k]['id'];?>" name="mode" class="t_list"><?php echo $sroot_pid[$k]['sroot_title'];?></div>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="dia_t" id="txtHinterji" style="display: none;"></div>
						<div class="dia_t" id="txtThreeattribute" style="display: none;"></div>
						<div class="dia_t">
							<div>面数</div>
							<div class="dia_t_list">
								<div rel="" name="mianshu" class="t_list_ms list_b">全部</div>
								<?php $sroot_mianshu = $db->select("sroot","sroot_pid=2","","id asc"); foreach ($sroot_mianshu as $k=>$v) :?>
									<div rel="<?php echo $sroot_mianshu[$k]['id'];?>" name="mianshu" class="t_list_ms">5k以下</div>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="dia_t">
							<div>布线</div>
							<div class="dia_t_list">
								<div rel="" name="buxian" class="t_list_bx list_b">全部</div>
								<?php $sroot_buxian = $db->select("sroot","sroot_pid=3","","id asc"); foreach ($sroot_buxian as $k=>$v) :?>
									<div rel="<?php echo $sroot_buxian[$k]['id'];?>" name="buxian" class="t_list_bx"><?php echo $sroot_buxian[$k]['sroot_title'];?></div>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="dia_t">
							<div>筛选</div>
							<div class="dia_t_list">
								<div rel="" name="shaixuan" class="t_list_sx list_b">全部</div>
								<?php $sroot_shaixuan = $db->select("sroot","sroot_pid=5","","id asc"); foreach ($sroot_shaixuan as $k=>$v) :?>
									<div rel="<?php echo $sroot_shaixuan[$k]['id'];?>" name="shaixuan" class="t_list_sx"><?php echo $sroot_shaixuan[$k]['sroot_title'];?></div>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="dia_t" style="border: 0;">
							<div>排序</div>
							<div class="dia_t_list">
								<div rel="" name="px" class="t_list_px list_b">综合</div>
								<div rel="zuixin" name="px" class="t_list_px">最新</div>
								<div rel="jiage" name="px" class="t_list_px">价格</div>
								<div rel="remen" name="px" class="t_list_px">热门</div>
								<div rel="xiazai" name="px" class="t_list_px">下载量</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<!-- <div class="btn">确认</div> -->
						<input type="submit" class="btn" value="确认"/>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="/m/js/index.js"></script>
	 <!-- 所有页面公共js -->
	 <script src="/m/js/public_all.js"></script>
</body>

</html>