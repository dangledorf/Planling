<?php 
include('includes/config/config.php');
include('includes/config/header.php');
?>
<div id="latest-shell">
	<article id="latest">
		<h1>Your upcoming lessons</h1>
		<table>
			<tr>
				<th class="tab"></th>
				<th>day</th>
				<th>time</th>
				<th>class</th>
				<th class="lesson">lesson</th>
				<th class="description">description</th>
				<th class="view"></th>
			</tr>

			<tr>
				<td class="tab col-bg-orange-red"><div class="fa fa-pencil"></div></td>
				<td>Monday<div class="date">October 14th, 2015</div><div class="date-small">10-15-2015</div></td>
				<td>1:00pm - 2:00pm</td>
				<td>Algebra I</td>
				<td class="lesson">Learning the basics</td>
				<td class="description">Much description, wow!</td>
				<td class="view"><a href="" class="btn col-bg-orange-red">View <div class="fa fa-arrow-circle-right"></div></td></td>
			</tr>
			<tr>
				<td class="tab col-bg-green"><div class="fa fa-pencil"></div></td>
				<td>Monday<div class="date">October 14th, 2015</div><div class="date-small">10-15-2015</div></td>
				<td>1:00pm - 2:00pm</td>
				<td>Algebra I</td>
				<td class="lesson">Learning the basics</td>
				<td class="description">Much description, wow!</td>
				<td class="view"><a href="" class="btn col-bg-green">View <div class="fa fa-arrow-circle-right"></div></td></td>
			</tr>
			<tr>
				<td class="tab col-bg-blue"><div class="fa fa-pencil"></div></td>
				<td>Monday<div class="date">October 14th, 2015</div><div class="date-small">10-15-2015</div></td>
				<td>1:00pm - 2:00pm</td>
				<td>Algebra I</td>
				<td class="lesson">Learning the basics</td>
				<td class="description">Much description, wow!</td>
				<td class="view"><a href="" class="btn col-bg-blue">View <div class="fa fa-arrow-circle-right"></div></td></td>
			</tr>
			<tr>
				<td class="tab col-bg-orange"><div class="fa fa-pencil"></div></td>
				<td>Monday<div class="date">October 14th, 2015</div><div class="date-small">10-15-2015</div></td>
				<td>1:00pm - 2:00pm</td>
				<td>Algebra I</td>
				<td class="lesson">Learning the basics</td>
				<td class="description">Much description, wow!</td>
				<td class="view"><a href="" class="btn col-bg-orange">View <div class="fa fa-arrow-circle-right"></div></td></td>
			</tr>
		</table>
		<a href="" class="btn btn-simple col-bg-sky-blue view-all full">View All</a>
	</article>
</div>

<?php include('includes/config/footer.php'); ?>