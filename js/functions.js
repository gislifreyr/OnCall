function showInfo(staff_id, context)
{
	hideInfo();
	var w = $('#info-window');
	ctx = $(context).offset();
	w.load('ajax/popup.php', {id:staff_id});
	ctx.left -= 300;
	w.css(ctx);
	w.css('z-index',100);
	w.show().animate({"width": "300px", "height": "150px", "left": "-=150px"}, "normal");

}

function hideInfo()
{
        var w = $('#info-window');
        w.css({"width":"0px", "height":"0px"});
        w.html("");
        w.hide();
}

function modifyEvent_cb(data)
{
	$('#calendar').fullCalendar('refetchEvents');
	if (!data.ok) // probably an error, 
	{
		alert("Error:" + data.error);
	}
}

function saveEvent(shift_id, staff_id, start, end)
{
	// adjust time, server expects UTC
	tzoffset = new Date().getTimezoneOffset();
	tzoffset *= 60; // getTimezoneOffset() returns minutes, we need seconds
	start -= tzoffset;
	end -= tzoffset;
	$.ajax({url:'ajax/event.php',data:{action:"save", shift:shift_id, staff:staff_id, start:start, end:end}, success:modifyEvent_cb,dataType: "json"});
}

function deleteEvent(shift_id)
{
	$.ajax({url:'ajax/event.php',data:{action:"delete", shift:shift_id}, success:modifyEvent_cb,dataType: "json"});
	hideMenu();
}

function showMenu(shift_id, context)
{
	hideMenu();
	var sm = $('#shift-menu');
	sm.css($(context).offset());
	sm.css('z-index',100);
	sm.html("<button onclick=\"deleteEvent(" + shift_id + ")\">Remove</button> <button onclick=\"hideMenu()\">X</button>")
	sm.show().animate({"width": "120px", "height": "30px", "top": "+=20px"}, "slow");
}

function hideMenu()
{
	var sm = $('#shift-menu');
	sm.css({"width":"120px", "height":"0px"});
	sm.html("");
	sm.hide();
}

function update_time()
{
        return $('#time-display').load('ajax/time.php'); 
}
