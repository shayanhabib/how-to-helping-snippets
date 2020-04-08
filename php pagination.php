<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<?php
$con = mysqli_connect("localhost", "root", "", "comma");
$tbl_name = "pulse";   //your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;

/* 
   First get total number of rows in data table. 
   If you have a WHERE clause in your query, make sure you mirror it here.
*/
$query = mysqli_query($con, "SELECT * FROM $tbl_name");
$total_pages = mysqli_num_rows($query);

/* Setup vars for query. */
$targetpage = "user-dashboard.php?client_id=1&";  //your file name  (the name of this file)
$limit = 1;                 //how many items to show per page
$page = @$_GET['page'];
if($page) 
  $start = ($page - 1) * $limit;      //first item to display on this page
else
  $start = 0;               //if no page var is given, set start to 0

/* Get data. */
$sql = "SELECT * FROM $tbl_name LIMIT $start, $limit";
$result = $con->query($sql);

/* Setup page vars for display. */
if ($page == 0) $page = 1;          //if no page var is given, default to 1.
$prev = $page - 1;              //previous page is page - 1
$next = $page + 1;              //next page is page + 1
$lastpage = ceil($total_pages/$limit);    //lastpage is = total pages / items per page, rounded up.
$lpm1 = $lastpage - 1;            //last page minus 1

/* 
  Now we apply our rules and draw the pagination object. 
  We're actually saving the code to a variable in case we want to draw it more than once.
*/
$pagination = "";
if($lastpage > 1)
{ 
  $pagination .= "<ul class=\"pagination\">";
  //previous button
  if ($page > 1) 
    $pagination.= "<li><a href=\"{$targetpage}page={$prev}\">previous</a><li>";
  else
    $pagination.= "<li class=\"disabled\"><a href='#'>previous</a></li>"; 
  
  //pages 
  if ($lastpage < 7 + ($adjacents * 2)) //not enough pages to bother breaking it up
  { 
    for ($counter = 1; $counter <= $lastpage; $counter++)
    {
      if ($counter == $page)
        $pagination.= "<li class=\"active\"><a>{$counter}</a></li>";
      else
        $pagination.= "<li><a href=\"{$targetpage}page={$counter}\">$counter</a></li>";
    }
  }
  elseif($lastpage > 5 + ($adjacents * 2))  //enough pages to hide some
  {
    //close to beginning; only hide later pages
    if($page < 1 + ($adjacents * 2))    
    {
      for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
      {
        if ($counter == $page)
          $pagination.= "<li class=\"active\"><a>{$counter}</a></li>";
        else
          $pagination.= "<li><a href=\"{$targetpage}page={$counter}\">{$counter}</a></li>";          
      }
      $pagination.= "<li><a>...</a></li>";
      $pagination.= "<li><a href=\"{$targetpage}page={$lpm1}\">{$lpm1}</a></li>";
      $pagination.= "<li><a href=\"{$targetpage}page={$lastpage}\">{$lastpage}</a></li>";    
    }
    //in middle; hide some front and some back
    elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    {
      $pagination.= "<li><a href=\"{$targetpage}page=1\">1</a></li>";
      $pagination.= "<li><a href=\"{$targetpage}page=2\">2</a></li>";
      $pagination.= "<li><a>...</a></li>";
      for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
      {
        if ($counter == $page)
          $pagination.= "<li class=\"active\"><a>{$counter}</a></li>";
        else
          $pagination.= "<li><a href=\"{$targetpage}page={$counter}\">{$counter}</a></li>";          
      }
      $pagination.= "<li><a>...</a></li>";
      $pagination.= "<li><a href=\"{$targetpage}page={$lpm1}\">{$lpm1}</a></li>";
      $pagination.= "<li><a href=\"{$targetpage}page={$lastpage}\">{$lastpage}</a></li>";    
    }
    //close to end; only hide early pages
    else
    {
      $pagination.= "<li><a href=\"{$targetpage}page=1\">1</a></li>";
      $pagination.= "<li><a href=\"{$targetpage}page=2\">2</a></li>";
      $pagination.= "<li><a>...</a></li>";
      for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
      {
        if ($counter == $page)
          $pagination.= "<li class=\"active\"><a>{$counter}</a></li>";
        else
          $pagination.= "<li><a href=\"{$targetpage}page={$counter}\">{$counter}</a></li>";          
      }
    }
  }
  
  //next button
  if ($page < $counter - 1) 
    $pagination.= "<li><a href=\"{$targetpage}page={$next}\">next</a></li>";
  else
    $pagination.= "<li class=\"disabled\"><a>next</a></li>";
  $pagination.= "</ul>\n";
}
?>

<?php
  while( $fetch_query = mysqli_fetch_array($result) ) {
  
    echo $fetch_query['pulse_id']."<Br>";
  
  }
?>

<?php echo $pagination; ?>