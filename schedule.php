<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Schedule Calendar</title>
        <link href='./calendar/fullcalendar/fullcalendar.css' rel='stylesheet' />
        <link href='./calendar/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
        <script src='./calendar/lib/jquery.min.js'></script>
        <script src='./calendar/lib/jquery-ui.custom.min.js'></script>
        <script src='./calendar/fullcalendar/fullcalendar.min.js'></script>
        <script>

            $(document).ready(function() {

                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();

                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,basicWeek,basicDay'
                    },
                    editable: false,
                  events: "events.php",
                  loading: function(bool) {
				if (bool) $('#loading').show();
				else $('#loading').hide();
			}
                });

            });

        </script>
        <style>

            body {
                margin-top: 40px;
                text-align: center;
                font-size: 10px;
                font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
            }

            #calendar {
                width: 1150px;
                margin: 0 auto;
            }

        </style>
    </head>
    <body>

        <div id='calendar'></div>
    </body>
</html>
