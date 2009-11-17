<?PHP

include "../index.php";

$shell['title3'] = "Linkify";

$shell['h2'] = 'Process links in text!';

$x = $_GET['x'];

// ========================================================================== //
// SCRIPT
// ========================================================================== //

ob_start();
?>
$(function(){
  
  // jQuery is used for this example, but JavaScript Linkify doesn't require
  // any third-party libraries.
  
  $('li').each(function(){
    var that = $(this),
      txt = that.html(),
      options = {
        callback: function( text, href ) {
          href && debug.log([ text, href ]);
          return href ? '<a href="' + href + '" title="' + href + '">' + text + '</a>' : text;
        }
      };
    
    that.html( txt + ' (orig)<br/>' + linkify( txt, options ) + ' (linkified)' );
  });
  
});
<?
$shell['script'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// HTML HEAD ADDITIONAL
// ========================================================================== //

ob_start();
?>
<script type="text/javascript" src="../../ba-linkify.js"></script>
<script type="text/javascript" language="javascript">

<?= $shell['script']; ?>

$(function(){
  
  // Syntax highlighter.
  SyntaxHighlighter.highlight();
  
});

</script>
<style type="text/css" title="text/css">

/*
bg: #FDEBDC
bg1: #FFD6AF
bg2: #FFAB59
orange: #FF7F00
brown: #913D00
lt. brown: #C4884F
*/

#page {
  width: 700px;
}

li {
  margin-bottom: 0.3em;
}

textarea {
  display: block;
  width: 50em;
  height: 8em;
  margin-bottom: 0.6em;
}

</style>
<?
$shell['html_head'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// HTML BODY
// ========================================================================== //

ob_start();
?>

<h3>Linkify some text:</h3>
<form action="" method="get">
  <textarea name="x"><?= htmlspecialchars( $x ); ?></textarea>
  <input type="submit" value="Submit"/>
</form>

<? if ( $x ) { ?>
<h3>Your text, linkified:</h3>
<ul>
  <li><?= htmlspecialchars( $x ); ?></li>
</ul>
<? } ?>

<h3>Some things probably shouldn't match:</h3>
<ul>
  <li>test.xyz</li>
  <li>test.xyz/</li>
  <li>test.xyz/foo</li>
  <li>[test.xyz]</li>
  <li>[test.xyz/]</li>
  <li>[test.xyz/foo]</li>
  <li>"http://benalman.a"</li>
  <li>"http://benalman.a/"</li>
  <li>[http://benalman.com]x </li>
  <li>100.200.300.400</li>
  <li>1000.2.3.4</li>
  <li>1.2.3</li>
  <li>100.200.300.400/foo</li>
  <li>1000.2.3.4/foo</li>
  <li>1.2.3/foo</li>
  <li>a1.2.3.4</li>
  <li>1.2.3.4a</li>
  <li>example.coma</li>
  <li>-example.coma</li>
  <li>path:to:file.pm</li>
  <li>/path/to/file.pl</li>
</ul>

<h3>But many things should:</h3>
<ul>
  <li>This is a bad link test.xyz/ and a few linkinus2-reg://a-b-c good 1.2.3.4 links [http://benalman.com] http://benalman.com/(url) together (http://benalman.com/(url)) here.</li>
  <li>This is a bad link 100.200.300.400/foo and a few example.com good example.com?x=1 links http://foo@benalman.com together "http://benalman.com/(url)" "http://benalman.com/" here.</li>
  <li>some bold and italics: <b>benalman.com</b>, <i>benalman.com/</i>, <b>benalman.com/foo</b>, <i>http://benalman.com</i>, <b>http://benalman.com/</b>, <i>foo@bar.com</i></li>
  <li>test (benalman.com), and (http://benalman.com/), and [foo.com,] {bar.com!}</li>
  <li>International domain names føøbár.ch (føøbár.ch) "føø-bár.ch" føø.bár.ch føøbár.ch/føø/bár should be linkified, but føø_bár.ch is not valid</li>
  <li>linkinus2-reg://a-b-c</li>
  <li>&lt;1.2.3.4&gt;</li>
  <li>&lt;http://1.2.3.4&gt;</li>
  <li>&lt;http://1.2.3.4/&gt;</li>
  <li>&laquo;http://1.2.3.4/&raquo;</li>
  <li>&quot;http://1.2.3.4/&quot;</li>
  <li>&amp;lt;http://1.2.3.4/&amp;gt;</li>
  <li>&amp;quot;http://1.2.3.4/&amp;quot;</li>
  <li>foo@bar.com</li>
  <li>mailto:foo@bar.com</li>
  <li>"foo@bar.com"</li>
  <li>"mailto:foo@bar.com"</li>
  <li>foo@bar.com?</li>
  <li>mailto:foo@bar.com?</li>
  <li>foo@bar.com.</li>
  <li>mailto:foo@bar.com.</li>
  <li>foo@bar.com?subject=Test%20subject&body=Hello%20there!</li>
  <li>ftp.example.com</li>
  <li>irc.example.com</li>
  <li>ftp://ftp.example.com</li>
  <li>irc://irc.example.com</li>
  <li>ftp.example.com/foo</li>
  <li>irc.example.com/foo</li>
  <li>ftp://ftp.example.com/foo</li>
  <li>irc://irc.example.com/foo</li>
  <li>a 1.2.3.4</li>
  <li>1.2.3.4 a</li>
  <li>a 1.2.3.4 a</li>
  <li>1.2.3.4</li>
  <li>1.2.3.4/foo</li>
  <li>ftp://1.2.3.4</li>
  <li>ftp://1.2.3.4/foo</li>
  <li>101.102.103.104</li>
  <li>joe@101.102.103.104</li>
  <li>omg-ponies://this:is:some:crap</li>
  <li>a [http://benalman.com]</li>
  <li>[http://benalman.com] b</li>
  <li>a [http://benalman.com] b</li>
  <li> [http://benalman.com]</li>
  <li>[http://benalman.com] </li>
  <li>[http://benalman.com]</li>
  <li>[http://benalman.com/]</li>
  <li>(http://benalman.com)</li>
  <li>(http://benalman.com/)</li>
  <li>"http://benalman.com"</li>
  <li>"http://benalman.com/"</li>
  <li>http://benalman.com/(url)</li>
  <li>"http://benalman.com/(url)"</li>
  <li>(http://benalman.com/(url))</li>
  <li>example.com</li>
  <li>example.com/</li>
  <li>example.tv</li>
  <li>example.tv/</li>
  <li>example.com?</li>
  <li>example.com/?</li>
  <li>(foo.com)</li>
  <li>"foo.com"</li>
  <li>[foo.com]</li>
  <li>[foo.com/]</li>
  <li>[foo.com/test]</li>
  <li>[foo.com/test/]</li>
  <li>example.com/foo</li>
  <li>example.com/foo/</li>
  <li>example.com?x=1</li>
  <li>example.com#y=2</li>
  <li>example.com?x=1#y=2</li>
  <li>example.tv</li>
  <li>test.example.com</li>
  <li>file:///foo.txt</li>
  <li>http://benalman.com</li>
  <li>http://benalman.com/</li>
  <li>http://benalman.xyz</li>
  <li>http://benalman.xyz/</li>
  <li>http://benalman.com?</li>
  <li>http://benalman.com/?</li>
  <li>http://benalman.xyz?</li>
  <li>http://benalman.xyz/?</li>
  <li>http://benalman.com"</li>
  <li>http://benalman.com/"</li>
  <li>http://benalman.xyz"</li>
  <li>http://benalman.xyz/"</li>
  <li>http://foo@benalman.com</li>
  <li>http://foo:bar@benalman.com</li>
  <li>http://benalman.com:81</li>
  <li>http://benalman.com:81/</li>
  <li>http://xyz@benalman.com:81/</li>
  <li>https://xyz@benalman.com:81/</li>
</ul>

<h3>parseuri examples</h3>
<ul>
  <li>http:</li>
  <li>https://</li>
  <li>http://host</li>
  <li>http://host/</li>
  <li>http://host.com</li>
  <li>http://subdomain.host.com</li>
  <li>http://host.com:81</li>
  <li>http://user@host.com</li>
  <li>http://user@host.com:81</li>
  <li>http://user:@host.com</li>
  <li>http://user:@host.com:81</li>
  <li>http://user:pass@host.com</li>
  <li>http://user:pass@host.com:81</li>
  <li>http://user:pass@host.com:81?query</li>
  <li>http://user:pass@host.com:81#anchor</li>
  <li>http://user:pass@host.com:81/</li>
  <li>http://user:pass@host.com:81/?query</li>
  <li>http://user:pass@host.com:81/#anchor</li>
  <li>http://user:pass@host.com:81/file.ext</li>
  <li>http://user:pass@host.com:81/directory</li>
  <li>http://user:pass@host.com:81/directory?query</li>
  <li>http://user:pass@host.com:81/directory#anchor</li>
  <li>http://user:pass@host.com:81/directory/</li>
  <li>http://user:pass@host.com:81/directory/?query</li>
  <li>http://user:pass@host.com:81/directory/#anchor</li>
  <li>http://user:pass@host.com:81/directory/sub.directory/</li>
  <li>http://user:pass@host.com:81/directory/sub.directory/file.ext</li>
  <li>http://user:pass@host.com:81/directory/file.ext?query</li>
  <li>http://user:pass@host.com:81/directory/file.ext?query=1&test=2</li>
  <li>http://user:pass@host.com:81/directory/file.ext?query=1#anchor</li>
  <li>//host.com</li>
  <li>//user:pass@host.com:81/direc.tory/file.ext?query=1&test=2#anchor</li>
  <li>/directory/sub.directory/file.ext?query=1&test=2#anchor</li>
  <li>/directory/</li>
  <li>/file.ext</li>
  <li>/?query</li>
  <li>/#anchor</li>
  <li>/</li>
  <li>?query</li>
  <li>?query=1&test=2#anchor</li>
  <li>#anchor</li>
  <li>path/to/file</li>
  <li>localhost</li>
  <li>192.168.1.1</li>
  <li>host.com</li>
  <li>host.com:81</li>
  <li>host.com:81/</li>
  <li>host.com?query</li>
  <li>host.com#anchor</li>
  <li>host.com/</li>
  <li>host.com/file.ext</li>
  <li>host.com/directory/?query</li>
  <li>host.com/directory/#anchor</li>
  <li>host.com/directory/file.ext</li>
  <li>host.com:81/direc.tory/file.ext?query=1&test=2#anchor</li>
  <li>user@host.com</li>
  <li>user@host.com:81</li>
  <li>user@host.com/</li>
  <li>user@host.com/file.ext</li>
  <li>user@host.com?query</li>
  <li>user@host.com#anchor</li>
  <li>user:pass@host.com:81/direc.tory/file.ext?query=1&test=2#anchor</li>
</ul>

<pre class="brush:js">
<?= htmlspecialchars( $shell['script'] ); ?>
</pre>

<?
$shell['html_body'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// DRAW SHELL
// ========================================================================== //

draw_shell();

?>
