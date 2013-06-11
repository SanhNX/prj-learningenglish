<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title></title>
	<link href="css/style.css" rel="stylesheet" type="text/css"/>
	<link href="css/admin-style.css" rel="stylesheet" type="text/css"/>
	<link href="css/date-picker.css" rel="stylesheet" type="text/css"/>
	<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="scripts/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-ui-1.10.2.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-colors-min.js"></script>
    <script type="text/javascript" src="scripts/admin-video.js"></script>
	<script type="text/javascript" src="scripts/date.js"></script>
	<script type="text/javascript" src="scripts/jquery.date-picker.js"></script>
	<script type="text/javascript" src="scripts/jquery.mCustomScrollbar.concat.min.js"></script>
	<script type="text/javascript" src="scripts/effect.js"></script>
</head>
<body>
<div class="page">
	<div class="nav">
		<ul class="nav-list">
			<li class="nav-item"><a href="#">Navigate 1</a></li>
			<li class="nav-item"><a href="#">Navigate 2</a></li>
			<li class="nav-item"><a href="#">Navigate 3</a></li>
			<li class="nav-item"><a href="#">Navigate 4</a></li>
			<li class="nav-item"><a href="#">Navigate 5</a></li>
		</ul>
	</div>

	<div class="form-head">
		<span>Learning-English</span><span class="form-head-gray"> • Manager Video</span>

		<div class="form-head-task">
			<div class="form-head-account">
				<div class="form-head-account-wrapper">
					<div class="form-head-profile">
						<span>Username</span>
						<span class="menu-popup-avt" style="background-image:url('images/resource/avt0.jpg')"></span>
					</div>
					<div class="form-head-logout"><a>Profile</a><a>Logout</a></div>
				</div>
			</div>
			<div class="form-head-search">
				<div class="form-head-search-mask">
					<input class="search-text" type="text" placeholder="Nhập nội dung tìm kiếm" value=""/>

					<div class="search-button"></div>
				</div>
			</div>

		</div>
	</div>
	<div class="form">
		<div class="admin-panel">
			<div class="profile-head">Add New Video</div>
			<div class="admin-panel-content">

				<div class="admin-title">* Input URL and press "validate" button to fetch data video from youtube site & enable form input !</div>
				<div class="table-row gap">
					<span class="admin-text-label">URL Address</span>
					<input id="url" class="admin-text-input" type="text">
					<input id="btn-validate" class="admin-button submit" type="button" value="Validate"/>
				</div>
				<div class="video-player">
					<iframe id="admin-player" width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
				</div>
				<div id="keyword-panel" class="table-row min-gap undisplayed">
					<div class="admin-text-label keyword inline">
						<span> Keyword:</span>
					</div>
					<div class="admin-keyword">
						<input id="admin-keyword-input" class="admin-text-input keyword" type="text"/>
						<input class="admin-button keyword add" type="button" value="Insert"/>
					</div>
				</div>
				<div id="rows-panel" class="table-row min-gap undisplayed">
					<div class="admin-text-label new-row inline">
						<div class="admin-time-row center">
							<span class="admin-current-time">00:05:23</span>
						</div>
						<div class="admin-time-row">
							<span>Start: </span>
							<input class="admin-table-text" type="text" value="00:00:00">
							<a class="admin-table-button time" id="admin-add-end-time"></a>
						</div>
						<div class="admin-time-row">
							<span>End: </span>
							<input class="admin-table-text" type="text" value="00:00:00">
							<a class="admin-table-button time" id="admin-add-start-time"></a>
						</div>
					</div>
					<textarea id="admin-textarea-input" class="admin-text-input new-row area" maxlength="500"></textarea>
					<input class="admin-button new-row add" type="button" value="Add"/>
				</div>
                <div id="hint-title" class="admin-title undisplayed">* Input hints list for keyword of current row !</div>
				<div id="hints-panel" class="table-row gap trend-right undisplayed">
					<div class="admin-text-label hint"><span>Hints:</span></div>
					<div class="admin-hint">
					<input class="admin-text-input hint" type="text" value="keyword 1">
					<input class="admin-text-input hint" type="text" value="keyword ">
					<input class="admin-text-input hint" type="text" value="keyword ">
					<input class="admin-text-input hint" type="text" value="keyword ">
					<input class="admin-text-input hint" type="text" value="keyword ">
					<input class="admin-text-input hint" type="text" value="keyword ">
					<input class="admin-text-input hint" type="text" value="">
					<input class="admin-text-input hint" type="text" value="keyword ">
					<input class="admin-text-input hint" type="text" value="">
					<input class="admin-text-input hint" type="text" value="">
					<input class="admin-text-input hint" type="text" value="">
					<input class="admin-text-input hint" type="text" value="">
					</div>
				</div>
				<table id="tbContent-panel" class="admin-table gap undisplayed">
					<thead class="admin-table-head">
					<tr>
						<td class="admin-table-cell">Head</td>
						<td class="admin-table-cell-full">Content</td>
						<td class="admin-table-cell">Control</td>
					</tr>
					</thead>
					<tbody>
					<tr class="admin-table-row">
						<td class="admin-table-cell">2:00→2:30</td>
						<td class="admin-table-cell-full">
						<span class="table-long-text">
						Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa.
						Duis tincidunt lectus quis dui viverra vestibulum.
						</span>
						</td>
						<td class="admin-table-cell">
							<input class="admin-table-button edit" type="button" value="Edit">
							<input class="admin-table-button delete" type="button" value="Remove">
						</td>
					</tr>
					<tr class="admin-table-row">
						<td class="admin-table-cell">2:30→3:10</td>
						<td class="admin-table-cell-full">
						<span class="table-long-text">
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
						Sed eleifend nonummy diam. Praesent mauris ante, elementum et.
						</span>
						</td>
						<td class="admin-table-cell">
							<input class="admin-table-button edit" type="button" value="Edit">
							<input class="admin-table-button delete" type="button" value="Remove">
						</td>
					</tr>
					<tr class="admin-table-row">
						<td class="admin-table-cell">3:10→3:20</td>
						<td class="admin-table-cell-full">
						<span class="table-long-text">
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
						Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa.
						Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh.
						Duis tincidunt lectus quis dui viverra vestibulum.
						</span>
						</td>
						<td class="admin-table-cell">
							<input class="admin-table-button edit" type="button" value="Edit">
							<input class="admin-table-button delete" type="button" value="Remove">
						</td>
					</tr>
					<tr class="admin-table-row">
						<td class="admin-table-cell">3:20→4:40</td>
						<td class="admin-table-cell-full">
						<span class="table-long-text">
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
						Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa.
						Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh.
						Duis tincidunt lectus quis dui viverra vestibulum.
						</span>
						</td>
						<td class="admin-table-cell">
							<input class="admin-table-button edit" type="button" value="Edit">
							<input class="admin-table-button delete" type="button" value="Remove">
						</td>
					</tr>
					</tbody>
					<tfoot class="admin-table-foot">
					<tr>
						<td class="admin-table-cell-full" colspan="3">
							<input class="admin-table-button prev unable" type="button" value="Cancel">
							<input class="admin-table-button next" type="button" value="Save">
						</td>
					</tr>
					</tfoot>
				</table>

			</div>

		</div>
		<div class="admin-footer"></div>
	</div>
</div>
</body>
</html>