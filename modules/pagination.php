<?php
	/*
	 * @author: Kadirov Yurij
	 * @website: https://sirkadirov.com/
	 * @email: admin@sirkadirov.com
	 */
	
	function generatePagination($pages_count, $current_page = 1, $view_links_count = 3, $service = "news", $addition = ""){
		
		//Проверяем, чтобы значение переменной, которая хранит номер текущей страницы
		//было меньше либо равно количеству страниц.
		if ($current_page <= $pages_count):
			
			//Объявляем массив элементов
			$links_array = array();
			
			//Заносим в массив $links_array элементы, не более $view_links_count штук
			//Элементы находятся до текущей страницы
			for ($i = $view_links_count; $i >= 1; $i--) {
				
				//Проверяем, может ли страница под номером ($current_page - $i) существовать
				if ($current_page - $i > 0)
					$links_array[$i] = $current_page - $i; //Записываем в массив

			}
			
			//Заносим текущую страницу в массив
			$links_array[0] = $current_page;
			
			//Заносим в массив $links_array элементы, не более $view_links_count штук
			//Элементы находятся после текущей страницы
			for ($i = 1; $i <= $view_links_count; $i++) {

				//Проверяем, может ли страница под номером ($current_page + $i) существовать
				if ($current_page + $i <= $pages_count)
					$links_array[$current_page + $i] = $current_page + $i; //Записываем в массив

			}
?>
<nav align="right" style="margin: 0; margin-top: 20px;">
	<ul class="pagination" style="margin: 0;">
		<li><a href="index.php?service=<?=$service?>&page=1<?=$addition?>">«</a></li>
<?php
			//Выводим ссылки на страницы в виде списка
			foreach ($links_array as $link){
				//Если текущий элемент - текущая страница, ссылку не создаём, а просто выводим
				//номер страницы, иначе - создаём ссылку.
				if ($link == $current_page)
					print("<li class='active'><a>" . $link . "</a></li>");
				else
					print("<li><a href='index.php?service=" . $service . "&page=" . $link . $addition . "'>" . $link . "</a></li>");
			}
?>
		<li><a href="index.php?service=<?=$service?>&page=<?=$pages_count . $addition?>">»</a></li>
	</ul>
</nav>
<?php
			
		endif;
		
	}
?>