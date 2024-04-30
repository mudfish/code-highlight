<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = htmlspecialchars($_POST['code'], ENT_QUOTES, 'UTF-8');
    $language = htmlspecialchars($_POST['language'], ENT_QUOTES, 'UTF-8');
    $showLineNumbers = isset($_POST['showLineNumbers']) && $_POST['showLineNumbers'] === 'true';
    // 根据是否显示行号添加相应的CSS类
    $lineNumbersClass = $showLineNumbers ? 'line-numbers' : '';

    // 根据语言加载对应的Prism.js组件（这里仅示例，实际场景可能需要调整）
    $languageScripts = [
        'javascript' => 'prism-javascript.min.js',
        // Add more languages as needed
    ];
    if (isset($languageScripts[$language])) {
        // In this example, we're not actually including scripts since they should be loaded in the HTML.
    }

    // 输出带有高亮类的代码块
    echo '<pre><code class="language-' . $language . ' ' . $lineNumbersClass . '">' . $code . '</code></pre>';
}
?>
