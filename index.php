<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Highlight with Bootstrap & jQuery</title>
    <link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/prism.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.26.0/plugins/line-numbers/prism-line-numbers.min.css">
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/prism.min.js"></script>
    <script src="js/components/prism-java.min.js"></script>
    <script src="js/components/prism-python.min.js"></script>
	<script src="js/components/prism-javascript.min.js"></script>
    <script src="js/components/prism-sql.min.js"></script>
    <script src="js/components/prism-bash.min.js"></script>
    <script src="js/components/prism-c.min.js"></script>
    <script src="js/components/prism-yaml.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.26.0/plugins/line-numbers/prism-line-numbers.min.js"></script>


    <style type="text/css">
        #highlightedCode{
            min-height: 480px;
            max-height: 500px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-light bg-light ">
        <div class="container-fluid text-center">
          <span class="navbar-brand mb-0 h1 text-center">Code-Highlight</span>
        </div>
      </nav>
	  
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-6">
            <form id="codeForm">
			<div class="row">
			    <div class="col-9">
                    <textarea id="codeInput" name="code" class="form-control" rows="20" required placeholder="请输入代码..."></textarea>
                </div>
				<div class="col-3">
                    <label for="languageSelect">选择语言:</label>
                    <select id="languageSelect" name="language" class="form-control" required>
                        <option value="java">Java</option>
                        <option value="python">Python</option>
                        <option value="php">PHP</option>
						<option value="markup">Html</option>
						<option value="javascript">Javascript</option>
                        <option value="sql">SQL</option>
                        <option value="bash">Bash</option>
                        <option value="c">C++</option>
                        <option value="csharp">C#</option>
						<option value="markup">XML</option>
                        <option value="yaml">YAML</option>
                    </select>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="showLineNumbers" id="showLineNumbers" value="true">
                        <label class="form-check-label" for="showLineNumbers">显示行号</label>
                    </div>
					<div class="text-center mt-2">
					   <button type="submit" class="btn btn-primary ">预览</button>
                       <button type="button" id="copyButton" class="btn btn-success ml-2" onclick="selectElementContents( document.getElementById('highlightedCode'));">复制</button>
					</div>
                </div> 
			</div>
            </form>
        </div>
		
        <div class="col-md-6 border">
             
             <div id="highlightedCode" class="mt-3 "></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#copyButton').hide();
        $('#codeForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: 'process_code.php',
                type: 'POST',
                data: formData,
                success: function(data) {
                    $('#highlightedCode').html(data);
                    Prism.highlightAll();
                    $('#copyButton').show(); // 显示复制按钮
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + status + " " + error);
                }
            });
        });

        
    });
	
  //js实现复制到剪贴板，带格式复制
  function selectElementContents(el) {
      var body = document.body, range, sel;
      if (document.createRange && window.getSelection) {
          range = document.createRange();
          sel = window.getSelection();
          sel.removeAllRanges();
		  range.selectNodeContents(el);
          sel.addRange(range);
          //range.selectNode(el);
          //sel.addRange(range);
          document.execCommand("copy");
          //取消文本选中状态
          window.getSelection().empty();
      }
  }

</script>

</body>
</html>
