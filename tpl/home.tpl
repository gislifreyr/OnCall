@import(header.tpl)
<div id="header">
	<div id="header-left">
		<div>
			<h1>OnCall</h1>
		</div>
		<div>
			<h3><span id="time-display">%time%</span> </h3>
		</div>
	</div>
	<div id="header-right">
		<h2>%s_name%</h2>
		<h3>%s_email%</h3>
		<h3>%s_simi%</h3>
		(<a href="logout.php">Logout</a>)
	</div>
    <div id="currently-oncall" class="softborder">
        <h4>Á vakt núna:</h4>
        <h4>%oncall%</h4>
    </div>
</div>
<div id="right-menu">
<ul>
%all_staff%
</ul>
</div>
<div id="shift-menu" class="softborder"></div>
<div id="info-window" class="softborder"></div>
<div id="main">
<div id="loading" style='display:none'>loading...</div>
<div id="calendar"></div>
</div>
@import(footer.tpl)
