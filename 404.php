<?include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');



CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена - Ошибка 404");
$APPLICATION->SetPageProperty("title", "Страница не найдена - Ошибка 404");
$APPLICATION->SetPageProperty("description", "Извините, но запрашиваемая Вами страница не найдена. Попробуйте воспользоваться другими разделами нашего сайта...");
$APPLICATION->AddChainItem("404");





$APPLICATION->AddHeadString('<meta name="description" content="Извините, но запрашиваемая Вами страница не найдена. Попробуйте воспользоваться другими разделами нашего сайта..." />');


?>



<p>Извините, но запрашиваемая Вами страница не найдена. Попробуйте воспользоваться другими разделами нашего сайта...</p>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
