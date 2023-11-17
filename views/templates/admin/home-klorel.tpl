{assign var="id_lang" value=Tools::getValue("id_lang")}

<div id="cinabre-custom-klorel">
    <section class="home-line1">
        <a href="{Configuration::get('CIN_HOME_UP_L1_LINK_LEFT'|cat:'_'|cat:$id_lang)}" class="home-line1-bloc1">
            <picture>
                <source srcset="{Configuration::get('CIN_HOME_UP_L1_IMG_MOBILE_LEFT')}, {Configuration::get('CIN_HOME_UP_L1_IMG_RETINA_MOBILE_LEFT')} 2x" media="(max-width: 414px)">
                <source srcset="{Configuration::get('CIN_HOME_UP_L1_IMG_TABLET_LEFT')}, {Configuration::get('CIN_HOME_UP_L1_IMG_RETINA_TABLET_LEFT')} 2x" media="(min-width: 415px) and (max-width: 768px)">
                <source srcset="{Configuration::get('CIN_HOME_UP_L1_IMG_DESKTOP_LEFT')}, {Configuration::get('CIN_HOME_UP_L1_IMG_RETINA_DESKTOP_LEFT')} 2x" media="(min-width: 769px)">
                <img src="{Configuration::get('CIN_HOME_UP_L1_IMG_DESKTOP_LEFT')}" alt="{Configuration::get('CIN_HOME_UP_L1_ALT_LEFT'|cat:'_'|cat:$id_lang)}">
            </picture>
            <span>{Configuration::get('CIN_HOME_UP_L1_TEXT_LEFT'|cat:'_'|cat:$id_lang)}</span>
        </a>
        <a href="{Configuration::get('CIN_HOME_UP_L1_LINK_RIGHT'|cat:'_'|cat:$id_lang)}" class="home-line1-bloc2">
            <picture>
                <source srcset="{Configuration::get('CIN_HOME_UP_L1_IMG_MOBILE_RIGHT')}, {Configuration::get('CIN_HOME_UP_L1_IMG_RETINA_MOBILE_RIGHT')} 2x" media="(max-width: 414px)">
                <source srcset="{Configuration::get('CIN_HOME_UP_L1_IMG_TABLET_RIGHT')}, {Configuration::get('CIN_HOME_UP_L1_IMG_RETINA_TABLET_RIGHT')} 2x" media="(min-width: 415px) and (max-width: 768px)">
                <source srcset="{Configuration::get('CIN_HOME_UP_L1_IMG_DESKTOP_RIGHT')}, {Configuration::get('CIN_HOME_UP_L1_IMG_RETINA_DESKTOP_RIGHT')} 2x" media="(min-width: 769px)">
                <img src="{Configuration::get('CIN_HOME_UP_L1_IMG_DESKTOP_RIGHT')}" alt="{Configuration::get('CIN_HOME_UP_L1_ALT_RIGHT'|cat:'_'|cat:$id_lang)}">
            </picture>
            <span>{Configuration::get('CIN_HOME_UP_L1_TEXT_RIGHT'|cat:'_'|cat:$id_lang)}</span>
        </a>
    </section>
    <section class="home-line2">
        <a href="{Configuration::get('CIN_HOME_UP_L2_LINK_LEFT'|cat:'_'|cat:$id_lang)}" class="home-line2-bloc1">
            <picture>
                <source srcset="{Configuration::get('CIN_HOME_UP_L2_IMG_MOBILE_LEFT')}, {Configuration::get('CIN_HOME_UP_L2_IMG_RETINA_MOBILE_LEFT')} 2x" media="(max-width: 414px)">
                <source srcset="{Configuration::get('CIN_HOME_UP_L2_IMG_TABLET_LEFT')}, {Configuration::get('CIN_HOME_UP_L2_IMG_RETINA_TABLET_LEFT')} 2x" media="(min-width: 415px) and (max-width: 768px)">
                <source srcset="{Configuration::get('CIN_HOME_UP_L2_IMG_DESKTOP_LEFT')}, {Configuration::get('CIN_HOME_UP_L2_IMG_RETINA_DESKTOP_LEFT')} 2x" media="(min-width: 769px)">
                <img src="{Configuration::get('CIN_HOME_UP_L2_IMG_DESKTOP_LEFT')}" alt="{Configuration::get('CIN_HOME_UP_L2_ALT_LEFT'|cat:'_'|cat:$id_lang)}">
            </picture>
            <span>{Configuration::get('CIN_HOME_UP_L2_TEXT_LEFT'|cat:'_'|cat:$id_lang)}</span>
        </a>
        <a href="{Configuration::get('CIN_HOME_UP_L2_LINK_RIGHT'|cat:'_'|cat:$id_lang)}" class="home-line2-bloc2">
            <picture>
                <source srcset="{Configuration::get('CIN_HOME_UP_L2_IMG_MOBILE_RIGHT')}, {Configuration::get('CIN_HOME_UP_L2_IMG_RETINA_MOBILE_RIGHT')} 2x" media="(max-width: 414px)">
                <source srcset="{Configuration::get('CIN_HOME_UP_L2_IMG_TABLET_RIGHT')}, {Configuration::get('CIN_HOME_UP_L2_IMG_RETINA_TABLET_RIGHT')} 2x" media="(min-width: 415px) and (max-width: 768px)">
                <source srcset="{Configuration::get('CIN_HOME_UP_L2_IMG_DESKTOP_RIGHT')}, {Configuration::get('CIN_HOME_UP_L2_IMG_RETINA_DESKTOP_RIGHT')} 2x" media="(min-width: 769px)">
                <img src="{Configuration::get('CIN_HOME_UP_L2_IMG_DESKTOP_RIGHT')}" alt="{Configuration::get('CIN_HOME_UP_L2_ALT_RIGHT'|cat:'_'|cat:$id_lang)}">
            </picture>
            <span>{Configuration::get('CIN_HOME_UP_L2_TEXT_RIGHT'|cat:'_'|cat:$id_lang)}</span>
        </a>
    </section>
    {widget name="ps_emailsubscription" hook="displayHome"}
    <section class="home-line-fullwidth">
        <a href="{Configuration::get('CIN_HOME_DOWN_L1_LINK_FULLWIDTH'|cat:'_'|cat:$id_lang)}" class="home-fullwidth-bloc">
            <picture>
                <source srcset="{Configuration::get('CIN_HOME_DOWN_L1_IMG_MOBILE_FULLWIDTH')}, {Configuration::get('CIN_HOME_DOWN_L1_IMG_RETINA_MOBILE_FULLWIDTH')} 2x" media="(max-width: 414px)">
                <source srcset="{Configuration::get('CIN_HOME_DOWN_L1_IMG_TABLET_FULLWIDTH')}, {Configuration::get('CIN_HOME_DOWN_L1_IMG_RETINA_TABLET_FULLWIDTH')} 2x" media="(min-width: 415px) and (max-width: 768px)">
                <source srcset="{Configuration::get('CIN_HOME_DOWN_L1_IMG_DESKTOP_FULLWIDTH')}, {Configuration::get('CIN_HOME_DOWN_L1_IMG_RETINA_DESKTOP_FULLWIDTH')} 2x" media="(min-width: 769px)">
                <img src="{Configuration::get('CIN_HOME_DOWN_L1_IMG_DESKTOP_FULLWIDTH')}" alt="{Configuration::get('CIN_HOME_DOWN_L1_ALT_FULLWIDTH'|cat:'_'|cat:$id_lang)}">
            </picture>
            <span>{Configuration::get('CIN_HOME_DOWN_L1_TEXT_FULLWIDTH'|cat:'_'|cat:$id_lang)}</span>
        </a>
    </section>
    <section class="home-line-trio">
        <a href="{Configuration::get('CIN_HOME_DOWN_L2_LINK_LEFT'|cat:'_'|cat:$id_lang)}" class="home-line-trio-bloc1">
            <picture>
                <source srcset="{Configuration::get('CIN_HOME_DOWN_L2_IMG_MOBILE_LEFT')}, {Configuration::get('CIN_HOME_DOWN_L2_IMG_RETINA_MOBILE_LEFT')} 2x" media="(max-width: 414px)">
                <source srcset="{Configuration::get('CIN_HOME_DOWN_L2_IMG_TABLET_LEFT')}, {Configuration::get('CIN_HOME_DOWN_L2_IMG_RETINA_TABLET_LEFT')} 2x" media="(min-width: 415px) and (max-width: 768px)">
                <source srcset="{Configuration::get('CIN_HOME_DOWN_L2_IMG_DESKTOP_LEFT')}, {Configuration::get('CIN_HOME_DOWN_L2_IMG_RETINA_DESKTOP_LEFT')} 2x" media="(min-width: 769px)">
                <img src="{Configuration::get('CIN_HOME_DOWN_L2_IMG_DESKTOP_LEFT')}" alt="{Configuration::get('CIN_HOME_DOWN_L2_ALT_LEFT'|cat:'_'|cat:$id_lang)}">
            </picture>
            <span>{Configuration::get('CIN_HOME_DOWN_L2_TEXT_LEFT'|cat:'_'|cat:$id_lang)}</span>
        </a>
        <a href="{Configuration::get('CIN_HOME_DOWN_L2_LINK_CENTER'|cat:'_'|cat:$id_lang)}" class="home-line-trio-bloc2">
            <picture>
                <source srcset="{Configuration::get('CIN_HOME_DOWN_L2_IMG_MOBILE_CENTER')}, {Configuration::get('CIN_HOME_DOWN_L2_IMG_RETINA_MOBILE_CENTER')} 2x" media="(max-width: 414px)">
                <source srcset="{Configuration::get('CIN_HOME_DOWN_L2_IMG_TABLET_CENTER')}, {Configuration::get('CIN_HOME_DOWN_L2_IMG_RETINA_TABLET_CENTER')} 2x" media="(min-width: 415px) and (max-width: 768px)">
                <source srcset="{Configuration::get('CIN_HOME_DOWN_L2_IMG_DESKTOP_CENTER')}, {Configuration::get('CIN_HOME_DOWN_L2_IMG_RETINA_DESKTOP_CENTER')} 2x" media="(min-width: 769px)">
                <img src="{Configuration::get('CIN_HOME_DOWN_L2_IMG_DESKTOP_CENTER')}" alt="{Configuration::get('CIN_HOME_DOWN_L2_ALT_CENTER'|cat:'_'|cat:$id_lang)}">
            </picture>
            <span>{Configuration::get('CIN_HOME_DOWN_L2_TEXT_CENTER'|cat:'_'|cat:$id_lang)}</span>
        </a>
        <a href="{Configuration::get('CIN_HOME_DOWN_L2_LINK_RIGHT'|cat:'_'|cat:$id_lang)}" class="home-line-trio-bloc3">
            <picture>
                <source srcset="{Configuration::get('CIN_HOME_DOWN_L2_IMG_MOBILE_RIGHT')}, {Configuration::get('CIN_HOME_DOWN_L2_IMG_RETINA_MOBILE_RIGHT')} 2x" media="(max-width: 414px)">
                <source srcset="{Configuration::get('CIN_HOME_DOWN_L2_IMG_TABLET_RIGHT')}, {Configuration::get('CIN_HOME_DOWN_L2_IMG_RETINA_TABLET_RIGHT')} 2x" media="(min-width: 415px) and (max-width: 768px)">
                <source srcset="{Configuration::get('CIN_HOME_DOWN_L2_IMG_DESKTOP_RIGHT')}, {Configuration::get('CIN_HOME_DOWN_L2_IMG_RETINA_DESKTOP_RIGHT')} 2x" media="(min-width: 769px)">
                <img src="{Configuration::get('CIN_HOME_DOWN_L2_IMG_DESKTOP_RIGHT')}" alt="{Configuration::get('CIN_HOME_DOWN_L2_ALT_RIGHT'|cat:'_'|cat:$id_lang)}">
            </picture>
            <span>{Configuration::get('CIN_HOME_DOWN_L2_TEXT_RIGHT'|cat:'_'|cat:$id_lang)}</span>
        </a>
    </section>
</div>