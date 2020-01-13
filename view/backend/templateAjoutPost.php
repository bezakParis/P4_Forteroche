<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="../../public/css/style.css" rel="stylesheet" />
		
		<script src="https://cdn.tiny.cloud/1/3ztlr4a9ila1dt21uqsn3rfezzi5k63pbjxhxqw4hw6qzj99/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
		<script>
			tinymce.init({
			  selector: 'textarea',
			  language:   "fr_FR",
			  language_url : '../../public/langs/fr_FR.js'  // site absolute URL
			});
		</script>
		
    </head>
        
    <body>
        <?= $content ?>
    </body>
</html>