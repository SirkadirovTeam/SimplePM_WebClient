<?php
	DEFINED("SPM_GENUINE") OR DIE('403 ACCESS DENIED');
	
	isset($_GET['page']) or $_GET['page'] = 1;
	
	(int)$_GET['page']>0 or $_GET['page']=1;
	
	if (!$db_result = $db->query("SELECT count(id) FROM `spm_news`"))
		die('Произошла непредвиденная ошибка при выполнении запроса к базе данных.<br/>');
	
	$total_articles_number = (int)($db_result->fetch_array()[0]);
	$articles_per_page = $_SPM_CONF["SERVICES"]["news"]["articles_per_page"];
	$current_page = (int)$_GET['page'];
	
	$db_result->free();
	unset($db_result);
	
	if ($total_articles_number > 0 && $articles_per_page > 0)
		$total_pages = ceil($total_articles_number / $articles_per_page);
	else
		$total_pages = 1;
	
	if ($current_page > $total_pages)
		$current_page = 1;
	
	//SQL queries and formatting
	if (!$db_result = $db->query("SELECT * FROM `spm_news` ORDER BY `id` DESC LIMIT " . ($current_page * $articles_per_page - $articles_per_page) . " , " . $articles_per_page . ";"))
		die('Произошла непредвиденная ошибка при выполнении запроса к базе данных.<br/>');
	
	
	SPM_header("Новости","Раздел новостей");
	
	//Create button
	if(permission_check($_SESSION['permissions'], PERMISSION::administrator)){
?>
<div align="right" style="margin-bottom: 10px;">
	<a href="index.php?service=news.admin&create" class="btn btn-success btn-flat">Создать новость</a>
	<a href="index.php?service=news.admin" class="btn btn-primary btn-flat">Управление</a>
</div>
<?php
	}
	
	if ($total_articles_number == 0 || $db_result->num_rows === 0){
?>
<div align="center">
	<h1>Упс!</h1>
	<p class="lead">Новостей ещё нет, но не огорчайтесь! Скоро они появятся! :)</p>
</div>
<?php
	}else{
			
		while ($article = $db_result->fetch_assoc()) {
?>
<div class="panel panel-primary" id="article-<?php print($article['id']); ?>" style="margin-bottom: 10px; border-radius: 0;">
	<div class="panel-heading" style="border-radius: 0;">
		<h3 class="panel-title"><a href="#article-<?php print($article['id']); ?>"><?php print($article['title']); ?></a></h3>
	</div>
	<div class="panel-body">
		<?php print(htmlspecialchars_decode($article['content'])); ?>
	</div>
	<div class="panel-footer">
		<a href="index.php?service=user&id=<?php print($article['authorId']); ?>">Профиль автора</a> / Дата публикации: <?php print($article['date']); ?>
		<?php
			if (permission_check($_SESSION['permissions'], PERMISSION::administrator)){
				print(" / <a href='index.php?service=news.admin&edit=" . $article['id'] . "'>Редактировать</a>");
			}
		?>
	</div>
</div>
<?php
		}
		unset($article);
		unset($db_result);
		
	}
?>

<?php include(_S_MOD_ . "pagination.php"); generatePagination($total_pages, $current_page, 4); ?>

<?php SPM_footer(); ?>