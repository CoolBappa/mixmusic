<?php
			// by default we show first page
			$pageNum = 1;
			
			// if $_GET['page'] defined, use it as page number
			if(isset($_GET['page']))
			{
				$pageNum = $_GET['page'];
			}
			
			$PAGE = $pageNum;
			// counting the offset
			$offset = ($pageNum - 1) * $rowsPerPage;			
			$limit = " LIMIT $offset, $rowsPerPage";
			
			// how many rows we have in database
			//$result = $db->numrow($pagingqry);
			if($pagingpassid == '' )
				$pagingpassid = 'id';
			$numrows = $db->numrow($pagingqry,$pagingpassid);
			
			//if records found
			if($numrows>0)
			{
					// how many pages we have when using paging?
					$maxPage = ceil($numrows/$rowsPerPage);
					
					// print the link to access each page
					$self = $_SERVER['PHP_SELF'].$gets;
					$nav  = '';
					
					 
					if($pageNum > 2)
					{
						$startpage = $pageNum - 2;
					}
					else
						$startpage = 1;
						
					$endpage = $startpage + 5;
					
					if($endpage > $maxPage)
						$endpage = $maxPage+1;
					
					if($maxPage > 1)
					{
						for($page = $startpage; $page < $endpage; $page++)
						{
						   if ($page == $pageNum)
						   {
							  $nav .= " <li class='active'><a href='#'>".$page." <span class='sr-only'>(current)</span></a></li>"; // no need to create a link to current page
						   }
						   else
						   {
							  $nav .= "<li><a href=\"$pagelink$page$htmlpage\">$page</a></li> ";
						   } 
						}
					}
								
					// creating previous and next link
					// plus the link to go straight to
					// the first and last page
					
					if ($pageNum > 1)
					{
					   $page  = $pageNum - 1;
					   $prev  = "<li><a href=\"$pagelink$page$htmlpage\">&laquo;</a></li>";
						$gofirst = 1;
					   $first = "<li><a href=\"$pagelink$gofirst$htmlpage\" >&laquo;&laquo;</a><li>";
					} 
					else
					{
					   $prev  = '<li class="disabled"><a href="#">&laquo;</a></li>'; // we're on page one, don't print previous link
					   $first = ''; // nor the first page link
					}
					
					if ($pageNum < $maxPage)
					{
					   $page = $pageNum + 1;
					   $next = "<li><a href=\"$pagelink$page$htmlpage\">&raquo;</a></li>";
					
					   $last = "<li><a href=\"$pagelink$maxPage$htmlpage\">&raquo;&raquo;</a></li>";
					} 
					else
					{
					   $next = ''; // we're on the last page, don't print next link
					   $last = '<li class="disabled"><a href="#">&raquo;</a></li>'; // nor the last page link
					}

						$jumppage = '';
						$jumppage .= '<form name="frme" class="basic-grey" method="get" action="'.BASE_PATH.'jumppage.php">';
						$jumppage .= '<p class="finfo">Jump to : ';
							$jumppage .= '<select name="page">';
							for($i=1;$i<=$maxPage;$i++)
							{
								if($i == $pageNum)
									$jumppage .= "<option value='$i' selected='selected'>$i</option>";
								else
									$jumppage .= "<option value='$i'>$i</option>";
							}
							$jumppage .= "</select>";
							$jumppage .= "<input type='submit' id='submit' name='go' value='Go' />";
							$jumppage .= "<input type='hidden' name='pagelink' value='".$pagelink."' />";
							$jumppage .= "<input type='hidden' name='htmlpage' value='".$htmlpage."' />";
						$jumppage .= '</p></form>';
						
			
					if($maxPage > 1)
					{
						// print the navigation link
                                          
				          
					  $str = $first . $prev . $nav . $next . $last  ;
					 
					}
					
					$PAGE_CODE = '<ul class="pagination pagination-lg" style="margin-top: 20px;">'.$str.'</ul>';
					
					
					
		}
		else
		{
			$PAGE_CODE = '<div class="page">Sorry, No Records Found</div>';
		}
			


?>

