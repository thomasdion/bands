<?php
function pagination($total_data, $page, $targetpage) {

	$targetpage = ROOT_URL."$targetpage"; 	//your file name  (the name of this file)
	if($page>1) 
		$start = ($page - 1) * _LIMIT_; //first item to display on this page
	else
		$start = 0;      		//if no page var is given, set start to 0

	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;			//if no page var is given, default to 1.
	$prev = $page - 1;		         	//previous page is page - 1
	$next = $page + 1;				//next page is page + 1
	$lastpage = ceil((int)$total_data/(int)_LIMIT_);  //lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;				  //last page minus 1
 
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = ""; //will contain the navigation menu
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev\">« prev</a>";
		else
			$pagination.= "<span class=\"disabled\">« prev</span>";	
		
		//pages	
		if ($lastpage < 7 + (_ADJACENTS_ * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + (_ADJACENTS_ * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + (_ADJACENTS_ * 2))		
			{
				for ($counter = 1; $counter < 4 + (_ADJACENTS_ * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - (_ADJACENTS_ * 2) > $page && $page > (_ADJACENTS_ * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - _ADJACENTS_; $counter <= $page + _ADJACENTS_; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + (_ADJACENTS_ * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\">next »</a>";
		else
			$pagination.= "<span class=\"disabled\">next »</span>";
		$pagination.= "</div>\n";		
	}
	
        $paginate['start'] = $start;
        $paginate['pagination'] = $pagination;
        $paginate['page'] = $page;
        $paginate['type'] = 0;

        return $paginate; 
}


 function paginationArgs($total_data, $page, $args, $targetpage) {
                    
        $arg_str = NULL;
        foreach ($args as $key => $value)                 
            $arg_str.='&'.$key.'='.$value;            
	$targetpage = ROOT_URL."$targetpage"; 	//your file name  (the name of this file)
	if($page>1) 
		$start = ($page - 1) * _LIMIT_; //first item to display on this page
	else
		$start = 0;      		//if no page var is given, set start to 0

	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;			//if no page var is given, default to 1.
	$prev = $page - 1;		         	//previous page is page - 1
	$next = $page + 1;				//next page is page + 1
	$lastpage = ceil((int)$total_data/(int)_LIMIT_);  //lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;				  //last page minus 1
 
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = ""; //will contain the navigation menu
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev$arg_str\">« prev</a>";
		else
			$pagination.= "<span class=\"disabled\">« prev</span>";	
		
		//pages	
		if ($lastpage < 7 + (_ADJACENTS_ * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter$arg_str\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + (_ADJACENTS_ * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + (_ADJACENTS_ * 2))		
			{
				for ($counter = 1; $counter < 4 + (_ADJACENTS_ * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter$arg_str\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1$arg_str\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage$arg_str\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - (_ADJACENTS_ * 2) > $page && $page > (_ADJACENTS_ * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1$arg_str\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2$arg_str\">2</a>";
				$pagination.= "...";
				for ($counter = $page - _ADJACENTS_; $counter <= $page + _ADJACENTS_; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter$arg_str\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1$arg_str\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage$arg_str\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1$arg_str\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2$arg_str\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + (_ADJACENTS_ * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter$arg_str\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next$arg_str\">next »</a>";
		else
			$pagination.= "<span class=\"disabled\">next »</span>";
		$pagination.= "</div>\n";		
	}
	
        $paginate['start'] = $start;
        $paginate['pagination'] = $pagination;
        $paginate['page'] = $page;
        $paginate['type'] = $args['type'];

        return $paginate; 

  }
?>
