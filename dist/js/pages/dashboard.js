$(function () {
  	'use strict'

	var ticksStyle = {
		// fontColor: '#495057',
		fontStyle: 'bold'
	}

	var mode = 'index'
	var intersect = true

  	// Make the dashboard widgets sortable Using jquery UI
	$('.connectedSortable').sortable({
		placeholder: 'sort-highlight',
		connectWith: '.connectedSortable',
		handle: '.card-header, .nav-tabs',
		forcePlaceholderSize: true,
		zIndex: 999999
	})
  	$('.connectedSortable .card-header').css('cursor', 'move')

	// jQuery UI sortable for the todo list
	$('.todo-list').sortable({
		placeholder: 'sort-highlight',
		handle: '.handle',
		forcePlaceholderSize: true,
		zIndex: 999999
	})

	$('.textarea').summernote()

	$('.daterange').daterangepicker({
		ranges: {
			Today: [moment(), moment()],
			Yesterday: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		startDate: moment().subtract(29, 'days'),
		endDate: moment()
	}, function (start, end) {
		alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
	})

	/* jQueryKnob */
	$('.knob').knob()

	// var $visitorsChart = $('#visitors-chart')

	// // eslint-disable-next-line no-unused-vars
	// var visitorsChart = new Chart($visitorsChart, {
	// 	data: {
	// 		labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
	// 		datasets: [{
	// 			type: 'line',
	// 			data: [100, 120, 170, 167, 180, 177, 160],
	// 			backgroundColor: 'transparent',
	// 			borderColor: '#007bff',
	// 			pointBorderColor: '#007bff',
	// 			pointBackgroundColor: '#007bff',
	// 			fill: false
	// 		}, {
	// 			type: 'line',
	// 			data: [60, 80, 70, 67, 80, 77, 100],
	// 			backgroundColor: 'tansparent',
	// 			borderColor: '#ced4da',
	// 			pointBorderColor: '#ced4da',
	// 			pointBackgroundColor: '#ced4da',
	// 			fill: false
	// 		}]
	// 	}, options: {
	// 		maintainAspectRatio: false,
	// 		tooltips: { mode: mode, intersect: intersect },
	// 		hover: { mode: mode, intersect: intersect },
	// 		legend: { display: false },
	// 		scales: { 
	// 			yAxes: [{
	// 				gridLines: { display: true, lineWidth: '4px', color: 'rgba(0, 0, 0, .2)', zeroLineColor: 'transparent' },
	// 				ticks: $.extend({ 
	// 					beginAtZero: true,
	// 					suggestedMax: 200
	// 				}, ticksStyle)
	// 			}], 
	// 			xAxes: [{
	// 				display: true,
	// 				gridLines: { display: false },
	// 				ticks: ticksStyle
	// 			}]
	// 		}
	// 	}
  	// })

	// The Calender
	$('#calendar').datetimepicker({
		format: 'L',
		inline: true
	})
})
