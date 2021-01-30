<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    $products = $faker->randomElement([
        [
            'title' => 'T-shirt',
            'description' => '<p>【科技介紹】 ．彈性拉伸構造，有助於改善運動靈活性 ．排潮面料，有助於讓你保持乾爽舒適</p>

            <p>【商品細節】 ．柔軟針織面料，網眼布通風設計，合您所需 ．舒適貼身的構造，有助於減輕皮膚摩擦.</p>
            
            <p>【商品材質】 ．主要面料：聚酯纖維，錦綸</p>
            
            <p>【適合運動】 ．適合訓練等運動</p>',
            'on_sale' => 1,
            'cover_image' => '/images/products/1/419a0a66ff30db6460ad5286e1da0a69.jfif',
            'images' => '["\/images\/products\/1\/b983d79552481798577054edb20d6521.jfif","\/images\/products\/1\/81210961a26f8d2f057da965e6bd6d27.jfif","\/images\/products\/1\/91f85b89ab3b7bcdb4929f230fb71c9d.jfif","\/images\/products\/1\/ce9acc7176dc04d3944f8b131f0ed473.jfif","\/images\/products\/1\/520f20378e685a7e35d71b6447faa602.jfif"]',
        ],
        [
            'title' => '口罩',
            'description' => '<p>💡超商(7-11/全家/萊爾富)取貨最多15包，不含其他商品💡</p>

            <p>💡超商(ok)取貨最多12包，不含其他商品💡</p>
            
            <p>💡超過請分開下單，或是下單宅配💡</p>
            
            <p>&nbsp;❤️週日至四當天下單・訂單２４Ｈ快速出貨❤️</p>
            
            <p>❤️１００％台灣發貨・省去漫長的運送時間❤️</p>
            
            <p>❤️商品１５天鑑賞期・安心購買多一層保障❤️</p>
            
            <p>🏆皇兒小舖🏆提供您最多元化的商品種類 💕💕</p>
            
            <p>－－－－－－－－－－－－－－－－</p>
            
            <p>拒絕髒空氣的侵襲❌</p>
            
            <p>不用再當人體空氣清淨機👌</p>
            
            <p>活性碳口罩給你更正規的保護💪</p>
            
            <p>『防塵』三層口罩給你全方位防護💫</p>
            
            <p>機車族、工廠作業適用🛵</p>
            
            <p>拒絕髒空氣的侵襲❌</p>
            
            <p>不用再當人體空氣清淨機👌</p>
            
            <p>活性碳口罩給你更正規的保護💪</p>
            
            <p>✅全方位覆蓋面部</p>
            
            <p>✅優質面料好呼吸</p>
            
            <p>✅機車族日常必備</p>
            
            <p>🔺多層高效濾層🔺</p>
            
            <p>高效過濾吸入空氣 有效阻擋灰塵進入</p>
            
            <p>🔺降低呼吸阻力🔺</p>
            
            <p>優質面料呼吸順暢 戴上口罩依舊自在</p>
            
            <p>🔺可塑魔術鼻條🔺</p>
            
            <p>方面用戶調節口罩 貼合臉部高效防護 不受灰塵花粉侵害</p>
            
            <p>🔺高彈力鬆緊繩🔺</p>
            
            <p>使用高彈力鬆緊繩 寬體耳帶不傷肌膚</p>
            
            <p>🔺機車族群必備🔺</p>
            
            <p>有效阻絕灰塵髒污 拒絕當人體清淨機 【進口三層防塵口罩】</p>
            
            <p>📍產品顏色：藍｜黃｜黑｜紫｜粉│果綠│橙色│寶藍│桃紅│橙黑│藏青│深紫│酒紅│墨綠</p>
            
            <p>📍產品尺寸：17.4 x 9.3 (&plusmn;0.5) cm</p>
            
            <p>📍產品重量：165克</p>
            
            <p>📍主要成分/材料：無紡布+熔噴布</p>
            
            <p>📍產品原產地：中國</p>
            
            <p>📍產品貨源：原廠公司貨</p>
            
            <p>📍保存期限：5年(未開封</p>
            
            <p>) 📍產品內容：防塵口罩x50入 商品名稱 進口三層口罩 製造商 仙桃市鴻亮無紡布製品有限公司 製造商電話 18071971828 製造商地址 中國湖北仙桃彭場鎮中嶺村 商品原產地 中國 進口商名稱 超皇有限公司 進口商電話 02-2648-2039 進口商地址 新北市汐止區工建路200-1號1樓 主要成分/材料 無紡布+熔噴布 度量/販售數量/販售規格：17.4 x 9.3 (&plusmn;0.5) cm / 50入/ 製造日期 2020/08/01 保存期限 5年(未開封) 中文標示 進口三層口罩</p>',
            'on_sale' => 1,
            'cover_image' => '/images/products/2/9a8eba5107c409dde682ceeb4f2d7826.jfif',
            'images' => '["\/images\/products\/2\/5b11b9aa1e1fe1168555d983ab4bbcde.jfif","\/images\/products\/2\/39ccdd2089e8d750bb85183de2ac459c.jfif"]',
        ],
        [
            'title' => '室內拖鞋',
            'description' => '<p>&nbsp;</p>

            <p>【iSlippers】台灣製造-簡約純色皮質室內拖鞋 **多件折扣說明- 多件折扣設定僅限同一商品頁,跨商品頁無法合併計算多件折扣**</p>
            
            <p>【商品規格】 M號(鞋長約25cm) L號(鞋長約26.5cm) XL號(鞋長約28cm)</p>
            
            <p>【商品特色】 純色。皮拖 *百分之百台灣製造 - 良心製造、質感佳 *皮質鞋面-不怕灰塵、髒污 - 清潔容易 *皮質內裡&ndash;不吸水潮濕、不藏垢 *靜音EVA鞋底&ndash;柔軟、安靜、不易卡垢；適合木質、磁磚..等各式地板 *鞋底增加抗滑處理 - 安全升級 *純色鞋面 - 簡約、大方 *顏色多樣 - 百搭、選擇多</p>
            
            <p>【使用說明】 水洗會縮短產品壽命,如需清潔,建議以濕布或免水洗清潔劑處理. 本商品為家居室內拖鞋,不可做為浴室拖鞋使用.</p>
            
            <p>【購買須知】 鑑賞期非試用期，考量個人衛生，產品如經使用，恕無法接受退換貨，請見諒。</p>',
            'on_sale' => 1,
            'cover_image' => '/images/products/3/69a5efdb7d0dae0a8d0a5e18c2bd4b28.jfif',
            'images' => '["\/images\/products\/3\/d794b69a9633e6629d962f352072522b.jfif","\/images\/products\/3\/e3b2ac0589400d571be546d849960674.jfif","\/images\/products\/3\/6b733cc57140e1127610df0a9130c3be.jfif","\/images\/products\/3\/ed70f79269ecaf9e381b52d4f3f1615d.jfif","\/images\/products\/3\/8a2bb479e08427abeb051d50d9bc9f6b.jfif"]',
        ],
        [
            'title' => '懶人眼鏡 臥室眼鏡 居家 懶人必備神器 躺著看電視看書 交換生日禮物 創意惡搞 創意商品 交換禮物',
            'description' => '<p>&nbsp;</p>

            <p>利用鏡面反射原理，躺著就能夠輕鬆享受電影雜誌，又能夠避免長時間久坐而傷脊椎、頸椎呢！</p>
            
            <p>本款產品的到來，不是宣傳什麼，就是用實力與良心說話，雖說眼鏡行業是個無底洞，但是打造一款好的眼鏡，無論是選材，配件，電焊，拋光，電鍍，等個個環節是要分開完成。 本款產品選用優質板材打造，質感強，鏡片選用優質的強化玻璃打造，達到100%防紫外線功能，板材眼鏡實用性很強，不容易變形，美學度高，韌性強。揭開眼鏡的秘密就是這個價！</p>',
            'on_sale' => 1,
            'cover_image' => '/images/products/4/611de59fed1f4adf77c4d502a9b8fdc7.jfif',
            'images' => '["\/images\/products\/4\/5bdc03b293fc6dc7964458d0ae22208c.jfif","\/images\/products\/4\/15296a95e2d859b11cf0ec72696287fc.jfif","\/images\/products\/4\/092ac38d66388ea7c270cc596c1feb24.jfif"]',
        ],
        [
            'title' => '藍牙耳機盒 保護套',
            'description' => '<p>顏色 : 黑色、白色、夜幕綠</p>',
            'on_sale' => 1,
            'cover_image' => '/images/products/5/53d15f4e5c6d49ac761157914ed60559.jfif',
            'images' => '["\/images\/products\/5\/4847531bf1dbc3387869395bc24c8f0a.jfif","\/images\/products\/5\/58d6b67dc312ce0d64a409c9bfef4054.jfif","\/images\/products\/5\/0413d6b9a0e568ac47790c9b04f7d90a.jfif","\/images\/products\/5\/216ff5f19e3068a7d57e3fca06f672d7.jfif"]',
        ],
    ]);
    $product = $products;
    $product['sold_count'] = $faker->numberBetween(0, 5);
    $product['review_count'] = $faker->numberBetween(0, 5);
    $product['price'] = 0;
    $product['created_at'] = date('Y-m-d h:m:s',time());
    $product['updated_at'] = date('Y-m-d h:m:s',time());

    return $product;
});
