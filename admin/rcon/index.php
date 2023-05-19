<!DOCTYPE HTML>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Minecraft RCON</title>
    <link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="static/css/style.css">
    <script type="text/javascript" src="static/js/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="static/js/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="static/js/jquery-ui-1.12.0.min.js"></script>
    <script type="text/javascript" src="static/js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="static/js/script.js" ></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA+5pVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1wTU06T3JpZ2luYWxEb2N1bWVudElEPSJ1dWlkOjY1RTYzOTA2ODZDRjExREJBNkUyRDg4N0NFQUNCNDA3IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkI0N0JDRjhEMDY5MTExRTI5OUZEQTZGODg4RDc1ODdCIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkI0N0JDRjhDMDY5MTExRTI5OUZEQTZGODg4RDc1ODdCIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDUzYgKE1hY2ludG9zaCkiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDowMTgwMTE3NDA3MjA2ODExODA4M0ZFMkJBM0M1RUU2NSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDowNjgwMTE3NDA3MjA2ODExODA4M0U3NkRBMDNEMDVDMSIvPiA8ZGM6dGl0bGU+IDxyZGY6QWx0PiA8cmRmOmxpIHhtbDpsYW5nPSJ4LWRlZmF1bHQiPmdseXBoaWNvbnM8L3JkZjpsaT4gPC9yZGY6QWx0PiA8L2RjOnRpdGxlPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PgFdWUIAAAExSURBVHjaxFUBEcIwDFxRMAmVMAnBQSVMAhImAQlIQAJzUBzgAByU9C7jspCsZdc7cvfHyNbPLcn/upRSVwOMiEiEW+05R4c3wznX48+T5/Cc6yrioJBNCBBpUJ4D+R8xflUQbbiwNuRrjzghHiy/IOcy4YC4svy44mTkk0KyF2Hh5S26de0i1rRoLya1RVTANyjQc065RcF45TvimFeT1vNIOS3C1xblqnRD25ZoCK8X4vs8T1z9orFYeGXYUHconI2OLswoKRbFlX5S8i9BFlK0irlAAhu3Q4F/5v0Ea8hy9diQrefB0sFoDWuRPxGPBvnKJrQCQ2uhyQLXBgXOlptCQzcdNKvwDd3UW27KhzyxgW5aQm5L8YMj5O8rLAGUBQn//+gbfvQS9jzXDuMtwAATXCNvATubRQAAAABJRU5ErkJggg==" />
</head>
<body>

  <style type="text/css">
    body {
      background-color: rgba( 38, 38, 38, 1);
      padding: 20px;
    }
    .alert-success {
      border: 1px solid rgba(7, 181, 53, 1);
      border-radius: 15px;
      color: white;
      background: rgba(2, 174, 2, 0.2);
    }
    .alert-info {
      border: 1px solid rgba(7, 13, 181, 1);
      background: rgba(0, 96, 255, 0.2);
      border-radius: 15px;
      color: white;
    }
    .alert-danger {
     border: 1px solid rgba(166, 0, 0, 1);
      border-radius: 15px;
      color: white;
      background: rgba(218, 28, 7, 0.1);
    }
    .alert-warning {
      border: 1px solid rgba(166, 0, 0, 1);
      border-radius: 15px;
      color: white;
      background: rgba(218, 28, 7, 0.1);
    }
    .list-group-item-success {
      border: 1px solid rgba(7, 181, 53, 1);
          
      color: white;
      background: rgba(2, 174, 2, 0.2);
    }
    .list-group-item-info {
      border: 1px solid rgba(7, 13, 181, 1);
      background: rgba(0, 96, 255, 0.2);
      
      color: white;
    }
    .list-group-item-danger {
border: 1px solid rgba(166, 0, 0, 1);
      
      color: white;
      background: rgba(218, 28, 7, 0.1);
    }
    .list-group-item-warning {
      border: 1px solid rgba(166, 0, 0, 1);
      
      color: white;
      background: rgba(218, 28, 7, 0.1);
    }
    ::-webkit-scrollbar {
  background: rgba( 34, 34, 34, 0.25 );
  width: 5px;
}


::-webkit-scrollbar-thumb {
background: rgb( 45, 45, 45);
width: 5px;
border-radius: 20px;
}
  </style>



  <div class="container-fluid" id="content">
    <div class="alert alert-info" id="alertMessage">
      Ркон консоль
    </div>
    <div id="consoleRow" style="border:0px; border-radius: 20px;">
      <div class="panel panel-default" id="consoleContent" style="border: 0px; border-top-left-radius: 20px; border-top-right-radius: 20px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; color: white;">
        <div class="panel-heading" style="border: 0px; border-top-left-radius: 15px; border-top-right-radius: 15px; background-color: rgba( 41, 41, 41, 1); color: white;">
          <h3 class="panel-title pull-left"><span class="glyphicon glyphicon-console"></span> Консоль</h3>
        </div>
        <div class="panel-body" style="border: 0px; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px; background-color: rgba( 47, 47, 47, 1);">
          <ul class="list-group" id="groupConsole"></ul>
        </div>
      </div>
      <div class="input-group" id="consoleCommand">
        <span class="input-group-addon" style="background-color: rgba( 41, 41, 41, 1); color: white; border: 0; border-top-left-radius: 15px; border-bottom-left-radius: 15px;">
          <input id="chkAutoScroll" type="checkbox" checked="true" autocomplete="off" /><span class="glyphicon glyphicon-arrow-down"></span>
        </span>
        <div id="txtCommandResults" ></div>
        <input type="text" class="form-control" id="txtCommand" style="border: 0px; background-color: rgba( 46, 46, 46, 0.8); color: white;">
        <div class="input-group-btn">
          <button type="button" class="btn btn-primary" id="btnSend" style="border: 1px solid rgba(7, 13, 181, 1);
      background: rgba(0, 96, 255, 0.2);"><span class="glyphicon glyphicon-send"></span><span class="hidden-xs"> Отправить</span></button>
          <button type="button" class="btn btn-warning" id="btnClearLog" style="border: 1px solid rgba(166, 0, 0, 1);
      
      color: white;
      background: rgba(218, 28, 7, 0.1); border-top-right-radius: 15px; border-bottom-right-radius: 15px;"><span class="glyphicon glyphicon-erase"></span><span class="hidden-xs"> Очистить</span></button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
