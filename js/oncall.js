$(document).ready(function() {
	$('.staff').each(function() {
			
		// figure out staff id from staff-X class (if the element has one!)
		// Venjulega myndi ég bæta við auka attribute í html-ið, t.d. "staffid"
		// og nota $.attr('staffid'), en þar sem þetta þarf að vera perfectly
		// validated, þá megiði njóta þessa skítahax hér að neðan, enjoy...
		classes = $(this).attr('class').split(/\s+/);
		staffid = null;
		for (var i = 0; i < classes.length; i++)
		{
			var m = classes[i].match(/^staff-(\d+)/)
			if (m != null)
				staffid = m[1];
		}
				
		var eventObject = {
			title: $.trim($(this).text()),
			staffid: staffid
		};

		$(this).data('eventObject', eventObject);

		$(this).draggable({
			zIndex: 999,
			revert: true,   
			revertDuration: 0 // látum hlutinn hverfa eftir dropp
		});
	});

	$('#calendar').fullCalendar({
	
		editable: true,
		droppable: true,
		
		events: "ajax/events.php",
		
		eventDrop: function(event, delta)
		{
			if (event.end == null)
				saveEvent(event.id, event.staffid, event.start.getTime()/1000, event.start.getTime()/1000);
			else
				saveEvent(event.id, event.staffid, event.start.getTime()/1000, event.end.getTime()/1000);
		},

		eventResize: function(event, delta)
		{
			if (event.end == null)
				saveEvent(event.id, event.staffid, event.start.getTime()/1000, event.start.getTime()/1000);
			else
				saveEvent(event.id, event.staffid, event.start.getTime()/1000, event.end.getTime()/1000);
		},

		eventClick: function(event, e)
		{
			showMenu(event.id, e.currentTarget);
		},

		eventRender: function(event, elem)
		{
			$(elem[0]).addClass("staff-"+event.staffid);
			$(elem[0]).addClass("softborder");
		},
		drop: function(d, allDay)
		{
			// this function is called when something is dropped
			// retrieve the dropped element's stored Event Object
			var ev = $(this).data('eventObject');
			to_date = new Date(d);
			to_date.setDate(d.getDate());
			saveEvent(null, ev.staffid, d.getTime()/1000, to_date.getTime()/1000);
		}, 

		loading: function(bool) {
			if (bool) $('#loading').show();
			else $('#loading').hide();
		}
	});
			
	// resize right menu to correct height
	viewport_h = ($(window).height()-$('#header').outerHeight());
	main_h = $('#main').outerHeight();
	$('#right-menu').height(Math.max(viewport_h,main_h));
    // update time on index.php every 10sec
    update_time();
    setInterval("update_time()", 10000);
	
});
	

