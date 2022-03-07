<?php 
session_start();
if(!isset($_SESSION['userData'])){
	header('location: ../signin');
}
?>


<!DOCTYPE html>
<html>

<head>


    <meta charset="UTF-8">

    <meta name="description" content="Free and open-source online code editor that allows you to write and execute code from a rich set of languages.">
    <meta name="keywords" content="online editor, online code editor, online ide, online compiler, online interpreter, run code online, learn programming online,
            online debugger, programming in browser, online code runner, online code execution, debug online, debug C code online, debug C++ code online,
            programming online, snippet, snippets, code snippet, code snippets, pastebin, execute code, programming in browser, run c online, run C++ online,
            run java online, run python online, run ruby online, run c# online, run rust online, run pascal online, run basic online">
    <meta name="author" content="Herman Zvonimir Došilović">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta property="og:title" content="Judge0 IDE - Free and open-source online code editor">
    <meta property="og:description" content="Free and open-source online code editor that allows you to write and execute code from a rich set of languages.">
    <meta property="og:image" content="https://raw.githubusercontent.com/judge0/ide/master/.github/wallpaper.png">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/golden-layout/1.5.9/goldenlayout.min.js" integrity="sha256-NhJAZDfGgv4PiB+GVlSrPdh3uc75XXYSM4su8hgTchI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/golden-layout/1.5.9/css/goldenlayout-base.css" integrity="sha256-oIDR18yKFZtfjCJfDsJYpTBv1S9QmxYopeqw2dO96xM=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/golden-layout/1.5.9/css/goldenlayout-dark-theme.css" integrity="sha256-ygw8PvSDJJUGLf6Q9KIQsYR3mOmiQNlDaxMLDOx9xL0=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        var require = {
            paths: {
                "vs": "https://unpkg.com/monaco-editor/min/vs",
                "monaco-vim": "https://unpkg.com/monaco-vim/dist/monaco-vim",
                "monaco-emacs": "https://unpkg.com/monaco-emacs/dist/monaco-emacs"
            }
        };
    </script>
    <script src="https://unpkg.com/monaco-editor/min/vs/loader.js"></script>
    <script src="https://unpkg.com/monaco-editor@0.32.1/min/vs/editor/editor.main.nls.js"></script>
    <script src="https://unpkg.com/monaco-editor@0.32.1/min/vs/editor/editor.main.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha256-9mbkOfVho3ZPXfM7W8sV2SndrGDuh7wuyLjtsWeTI1Q=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js" integrity="sha256-t8GepnyPmw9t+foMh3mKNvcorqNHamSKtKRxxpUEgFI=" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">

    <script type="text/javascript" src="third_party/download.js"></script>

    <script type="text/javascript" src="js/ide.js"></script>

    <link type="text/css" rel="stylesheet" href="css/ide.css">

    <title>VClub IDE -online code editor</title>
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">

    <style>
        h2 {

            margin-top: 100px;
            font-family: 'Exo 2', sans-serif;
        }
    </style>

</head>

<body>

    <div id="site-navigation" class="ui small inverted menu">
        <div id="site-header" class="header item">
            <a href="/">
                <img id="site-icon" src="./images/round_logo.png">

            </a>
        </div>

        <div class="item borderless wide screen only">
            <h2>VProject IDE<h2>
        </div>
        <div class="left menu">


            <div class="item borderless">
                <select id="select-language" class="ui dropdown">

                    <option value="75" mode="c">C (Clang 7.0.1)</option>

                    <option value="51" mode="csharp">C# (Mono 6.6.0.161)</option>

                    <option value="76" mode="cpp">C++ (Clang 7.0.1)</option>
                    -->
                    <option value="70" mode="python">Python (2.7.17)</option>
                    <option mode="java" value="62">Java (OpenJDK 13.0.1)</option>

                </select>
            </div>
            <div class="item fitted borderless wide screen only">
                <div class="ui input">
                    <input id="compiler-options" type="text" placeholder="Compiler options"></input>
                </div>
            </div>
            <div class="item borderless wide screen only">
                <div class="ui input">
                    <input id="command-line-arguments" type="text" placeholder="Command line arguments"></input>
                </div>
            </div>
            <div class="item no-left-padding borderless">
                <button id="run-btn" class="ui primary labeled icon button"><i class="play icon"></i>Run (F9)</button>
            </div>

            <div class="item borderless wide screen only">
                <button  class="ui primary labeled icon button" onClick="myFunction()">Logout</button>
            </div>
            <div id="navigation-message" class="item borderless">
                <span class="navigation-message-text"></span>
            </div>
        </div>

    </div>
    <script>
        function myFunction() {
            window.location.href = "logout.php";
        }
    </script>
    <div id="site-content"></div>

    <div id="site-modal" class="ui modal">
        <div class="header">
            <i class="close icon"></i>
            <span id="title"></span>
        </div>
        <div class="scrolling content"></div>
        <div class="actions">
            <div class="ui small labeled icon cancel button">
                <i class="remove icon"></i>
                Close (ESC)
            </div>
        </div>
    </div>


    <div id="site-settings" class="ui modal">
        <i class="close icon"></i>
        <div class="header">
            <i class="cog icon"></i>
            Settings
        </div>
        <div class="content">
            <div class="ui form">
                <div class="inline fields">
                    <label>Editor Mode</label>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="editor-mode" value="normal" checked="checked">
                            <label>Normal</label>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="editor-mode" value="vim">
                            <label>Vim</label>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="editor-mode" value="emacs">
                            <label>Emacs</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div id="site-footer">
   
        <div id="editor-status-line"></div>
        <span>© 2022 <a href="https://VProject.csivitap.co.in/">VProject - CSI VIT-AP</a>
            <span id="status-line"></span>
    </div>
</body>

</html>