<style type="text/css">
        html,
        body {
            height: 90%;
            /* height:100%; */
            padding: 0px;
            margin: 0px;
            /* margin: unset; */
            /* overflow: hidden; */
        }

        .gantt_task_content {
            color: #0c0c0c;
        }

        .status_line {
            background-color: #0ca30a;
        }

        #gantt_here {
            width: 90%;
            height: 90%;
        }

        .gantt_grid_scale .gantt_grid_head_cell,
        .gantt_task .gantt_task_scale .gantt_scale_cell {
            font-weight: bold;
            font-size: 14px;
            color: rgba(0, 0, 0, 0.7);
        }

        .resource_marker {
            text-align: center;
        }

        .resource_marker div {
            width: 28px;
            height: 28px;
            line-height: 29px;
            display: inline-block;
            border-radius: 15px;
            /* color: #FFF; */
            color: #1b1b1b;
            margin: 3px;
        }

        .gantt_task_line  {
            background-color: rgb(195, 197, 195);
            /* opacity: 0.2; */
        }

        .gantt_task_line.gantt_task_inline_color  {
            background-color: rgb(169, 241, 181);
            /* opacity: 0.2; */
        }

        .gantt_task_progress {
            text-align: left;
            padding-left: 10px;
            box-sizing: border-box;
            color: black;
            font-weight: bold;
        }

        .resource_marker.workday_ok div {
            background: #51c185;
        }

        .resource_marker.workday_over div {
            background: #ff8686;
        }

        .weekend {
            background: #f4f7f4 !important;
        }
    </style>
<div class="card">
<form class="gantt_control">
        <input type="button" value="Zoom In" onclick="zoomIn()">
        <input type="button" value="Zoom Out" onclick="zoomOut()">

        <input type="radio" id="scale1" class="gantt_radio" name="scale" value="day">
        <label for="scale1">Day scale</label>

        <input type="radio" id="scale2" class="gantt_radio" name="scale" value="week" - checked>
        <label for="scale2">Week scale</label>

        <input type="radio" id="scale3" class="gantt_radio" name="scale" value="month">
        <label for="scale3">Month scale</label>

        <input type="radio" id="scale4" class="gantt_radio" name="scale" value="quarter">
        <label for="scale4">Quarter scale</label>

        <input type="radio" id="scale5" class="gantt_radio" name="scale" value="year">
        <label for="scale5">Year scale</label>

    </form>
    <div id="gantt_here" style='width:100%; height:calc(100vh - 52px);'></div>

    <script>
        console.log('Enter gantt');
        gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";

        var zoomConfig = {
            levels: [{
                    name: "day",
                    scale_height: 27,
                    min_column_width: 80,
                    scales: [{
                        unit: "day",
                        step: 1,
                        format: "%d %M"
                    }]
                },
                {
                    name: "week",
                    scale_height: 50,
                    min_column_width: 50,
                    scales: [{
                            unit: "week",
                            step: 1,
                            format: function(date) {
                                var dateToStr = gantt.date.date_to_str("%d %M");
                                var endDate = gantt.date.add(date, -6, "day");
                                var weekNum = gantt.date.date_to_str("%W")(date);
                                return "#" + weekNum + ", " + dateToStr(date) + " - " + dateToStr(endDate);
                            }
                        },
                        {
                            unit: "day",
                            step: 1,
                            format: "%j %D"
                        }
                    ]
                },
                {
                    name: "month",
                    scale_height: 50,
                    min_column_width: 120,
                    scales: [{
                            unit: "month",
                            format: "%F, %Y"
                        },
                        {
                            unit: "week",
                            format: "Week #%W"
                        }
                    ]
                },
                {
                    name: "quarter",
                    height: 50,
                    min_column_width: 90,
                    scales: [{
                            unit: "month",
                            step: 1,
                            format: "%M"
                        },
                        {
                            unit: "quarter",
                            step: 1,
                            format: function(date) {
                                var dateToStr = gantt.date.date_to_str("%M");
                                var endDate = gantt.date.add(gantt.date.add(date, 3, "month"), -1, "day");
                                return dateToStr(date) + " - " + dateToStr(endDate);
                            }
                        }
                    ]
                },
                {
                    name: "year",
                    scale_height: 50,
                    min_column_width: 30,
                    scales: [{
                        unit: "year",
                        step: 1,
                        format: "%Y"
                    }]
                }
            ]
        };

        gantt.ext.zoom.init(zoomConfig);
        gantt.ext.zoom.setLevel("week");
        gantt.ext.zoom.attachEvent("onAfterZoom", function(level, config) {
            document.querySelector(".gantt_radio[value='" + config.name + "']").checked = true;
        })

        gantt.plugins({
            tooltip: true,
            marker: true,
            keyboard_navigation: true,
        });
        gantt.attachEvent("onGanttReady", function() {
            var tooltips = gantt.ext.tooltips;
            tooltips.tooltip.setViewport(gantt.$task_data);
        });

        gantt.config.order_branch = false;
        gantt.config.open_tree_initially = false;

        gantt.config.columns = [{
                name: "text",
                align: "left",
                tree: true,
                width: 200,
                resize: true,
            },
            {
                name: "start_date",
                align: "center",
                width: 80,
                resize: true
            },
            {
                name: "duration",
                width: 60,
                align: "center"
            }
        ];


        gantt.templates.tooltip_text = function(start, end, task) {
            $tp = "<b>name:</b> " + task.text +
                "<br/><b>Department:</b> " + task.department +
                "<br/><b>Start:</b> " + task.start_date +
                "<br/><b>End:</b> " + task.end_date +
                // "<br/><b>Duration:</b> " + task.duration;
                "<br/><b>Progress:</b> " + task.progress*100 + "%";
            return $tp;
            // "<b>Taskxxx:</b> " + task.text + "<br/><b>Duration:</b> " + task.duration;
        };

        // gantt.plugins({
        //     marker: true
        // });

        var dateToStr = gantt.date.date_to_str(gantt.config.task_date);
        var today = new Date;
        console.log(today);
        gantt.addMarker({
            start_date: today,
            css: "today",
            text: "Today",
            title: "Today: " + dateToStr(today)
        });

        gantt.templates.leftside_text = function(start, end, task) {
            return task.duration + " days";
        };

        gantt.templates.scale_cell_class = function(date) {
            if (date.getDay() == 6 || date.getDay() == 5) {
                return "weekend";
            }
        };
        gantt.templates.timeline_cell_class = function(item, date) {
            if (date.getDay() == 6 || date.getDay() == 5) {
                return "weekend"
            }
        };

        gantt.templates.progress_text = function(start, end, task) {
            return "<span style='text-align:left;'>" + Math.round(task.progress*100) + "% </span>";
        };

        var resourcesStore = gantt.createDatastore({
            name: gantt.config.resource_store,
            type: "treeDatastore",
            initItem: function(item) {
                item.parent = item.parent || gantt.config.root_id;
                item[gantt.config.resource_property] = item.parent;
                item.open = true;
                return item;
            }
        });

        gantt.attachEvent("onTaskCreated", function(task) {
            task[gantt.config.resource_property] = [];
            return true;
        });

        // console.log('before projectId');

        projectId = <?php echo json_encode($project->id); ?>


        // console.log(projectId);

        gantt.init("gantt_here", new Date(2022, 8, 1), new Date(2030, 10, 1));
        gantt.load("/api/data/" + projectId);
        // gantt.load("/api/data/". $projectId);

        var dp = new gantt.dataProcessor("/api");

        // console.log(dp);

        gantt.config.layout = {
            css: "gantt_container",
            rows: [{
                    cols: [{
                            view: "grid",
                            group: "grids",
                            scrollY: "scrollVer"
                        },
                        {
                            resizer: true,
                            width: 1
                        },
                        {
                            view: "timeline",
                            scrollX: "scrollHor",
                            scrollY: "scrollVer"
                        },
                        {
                            view: "scrollbar",
                            id: "scrollVer",
                            group: "vertical"
                        }
                    ],
                    gravity: 2
                },
                {
                    resizer: true,
                    width: 1
                },

                {
                    view: "scrollbar",
                    id: "scrollHor"
                }
            ]
        };

        gantt.config.drag_progress = false;
        gantt.config.details_on_dblclick = false;

        // gantt.config.layout = without_grids_layout;
        // ********************* initiate **********************//
        dp.init(gantt);
        dp.setTransactionMode("REST");
        // gantt.parse(demo_tasks);

        function zoomIn() {
            gantt.ext.zoom.zoomIn();
        }

        function zoomOut() {
            gantt.ext.zoom.zoomOut()
        }

        var radios = document.getElementsByName("scale");
        for (var i = 0; i < radios.length; i++) {
            radios[i].onclick = function(event) {
                gantt.ext.zoom.setLevel(event.target.value);
            };
        }
    </script>
</div>