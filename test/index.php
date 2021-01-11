<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
	<div class="page-wrapper">    <div class="iframe-form-calculator">
                <div class="block-wrapper" style="display: none;"></div>
        <form id="iframe-cform">
            <a target="_blank" href="https://vozovoz.ru/?utm_source=partner_site&amp;utm_medium=iframe" class="center-logo" data-place="0">
                <img src="/assets/build/images/logo2.png?v=0.2">
                            </a>                <div class="iframe-from-gate-dispatch row" data-place="1">
        <div class="relative form-group col-xs-8" data-type="locationdispatch">
                <div class="grey font-12">Откуда</div>
        <select name="location_dispatch" id="location_dispatch" class="material-select select2-hidden-accessible" tabindex="-1" aria-hidden="true">
            <option selected="" value="e90f1820-0128-11e5-80c7-00155d903d03">Москва г</option>
        </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-location_dispatch-container"><span class="select2-selection__rendered" id="select2-location_dispatch-container" title="Москва г">Москва г</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
    </div>
    <div data-block="type" class="col-xs-4 recalc-req-contains">
                <ul class="clear-list">
            <li class="pad-top-25">
                <input class="with-gap" data-force-return="" type="checkbox" id="dispatch_address" value="address" name="dispatch_point">
                <label for="dispatch_address" data-toggle="popover" data-placement="top" data-trigger="hover">От адреса</label>
            </li>
        </ul>
    </div>
</div>                <div class="iframe-from-gate-destination row" data-place="2">
        <div class="relative form-group col-xs-8" data-type="locationdestination">
                <div class="grey font-12">Куда</div>
        <select name="location_destination" id="location_destination" class="material-select select2-hidden-accessible" tabindex="-1" aria-hidden="true">
            <option selected="" value="e90f19de-0128-11e5-80c7-00155d903d03">Санкт-Петербург г</option>
        </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-location_destination-container"><span class="select2-selection__rendered" id="select2-location_destination-container" title="Санкт-Петербург г">Санкт-Петербург г</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
    </div>
    <div data-block="type" class="col-xs-4 recalc-req-contains">
                <ul class="clear-list">
            <li class="pad-top-25">
                <input class="with-gap" data-force-return="" type="checkbox" id="destination_address" value="address" name="destination_point">
                <label for="destination_address" data-toggle="popover" data-placement="top" data-trigger="hover">До адреса</label>
            </li>
        </ul>
    </div>
</div>            <div class="iframe-cform-dimensions row" data-place="3">
                                                <div class="col-xs-4 padd-0 marg-right-20 relative">
                    <input name="volume" id="bis_amount" autocomplete="off" class="numeric focus" data-numeric-check-on-blur="true" data-numeric-check-on-enter="true" data-numeric-float="true" data-numeric-excess="2" type="text" data-numeric-min="0.01" data-numeric-max="74" placeholder="Объем" value="0.1">
                    <span>м<sup>3</sup></span>
                </div>
                <div class="col-xs-4 padd-0">
                        <input name="weight" id="bis_mass" autocomplete="off" class="numeric focus" data-numeric-check-on-blur="true" data-numeric-check-on-enter="true" data-numeric-float="true" data-numeric-excess="1" type="text" data-numeric-min="0.1" data-numeric-max="19999" placeholder="Вес" value="0.1"><span>кг</span>
                </div>
            </div>
            <div class="insurance-block row" data-place="4">
                                                <span>Страхование: </span>
                <input name="insurance" id="insurance" autocomplete="off" class="numeric focus" placeholder="сумма" data-numeric-check-on-blur="true" data-numeric-check-on-enter="true" data-numeric-float="true" data-numeric-excess="1" type="text" data-numeric-max="40000000" maxlength="8" value=""><span>₽</span>
            </div>
            <div class="package-block row" data-place="5">
                                                <div class="form-group">
                    <select name="package" id="package" autocomplete="off" class="material-select select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                        <option value="">Без упаковки</option><option value="palletCollar">Паллетный борт</option><option value="palletizingExtraPackageVolume">Паллетирование (прозрачный стрейч)</option><option value="hardPackageVolume">Жёсткая упаковка</option><option value="palletizingExtraBlackPackageVolume">Паллетирование (чёрный стрейч)</option><option value="extraPackageVolume">Дополнительная упаковка (прозрачная плёнка)</option><option value="palletizingBubbleFilmVolume">Паллетирование (воздушно-пузырьковая плёнка)</option><option value="extraBlackPackageVolume">Дополнительная упаковка (чёрная плёнка)</option><option value="bubbleFilmVolume">Воздушно-пузырьковая пленка</option></select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 355px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-package-container"><span class="select2-selection__rendered" id="select2-package-container" title="Без упаковки">Без упаковки</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
            </div>
            <div class="price-and-delivery-time" data-place="6">
                <a href="#" class="btn btn-default btn-md btn-block">Стоимость и срок доставки</a>
            </div>
            <div class="row total-mini-order-iframe" style="display: none;">
                <span class="iframe-total-close icon-close" title="закрыть"></span>
                <div class="alert alert-danger none"></div>
                <div class="col-xs-12 marg-bot-20">
                    <div class="clearfix pad-top-5 font-18">
                        Стоимость: <span class="pull-right minicalc_form_result_nodisc" data-currency="₽">{{price}}</span>
                    </div>
                </div>
                <div class="col-xs-12 marg-bot-20">
                    <div class="clearfix pad-top-5 font-18">Срок доставки: <span class="pull-right delivery-time">от {{from}} до {{to}} дней</span>
                    </div>
                </div>
                <div class="col-xs-12">
                    <a href="/order/create/" class="btn btn-default btn-md btn-block">Оформить перевозку</a>
                    <a href="" class="none" target="parent">перейти на оформление</a>
                </div>
            </div>
        </form>
    </div>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>