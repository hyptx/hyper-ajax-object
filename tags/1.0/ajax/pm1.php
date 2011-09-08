<?php 
include('../hao.php');

//This is the dynamic "Ghost Object" - setting the query here ensures true page memory
$ajax_object_pm = hypAjaxObject::create('div_id=page-mem1&is_dynamic=true');
$ajax_object_pm->set_hyp_query($_GET);

echo '<strong>Query String: </strong>';
echo http_build_query($_GET);
echo '<br><br>';
print_r($_GET);
echo '<br><hr />';
echo '<strong>If above fields empty, <a href="http://hao.hyperspatial.com?page-mem1=true&page=7&cat=ajax&fun=yes">click here</a> or enter this url into the address bar:</strong> http://hao.hyperspatial.com?page-mem1=true&page=7&cat=ajax&fun=yes';
?>