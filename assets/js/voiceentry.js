const voiceentry = () => {
  const _form = $('.js-ve-form'),
        _preview = $('.js-ve-preview'),
        _tab_form = $('.js-ve-tabbar-form'),
        _tab_preview = $('.js-ve-tabbar-preview'),
        _clone = $('.js-ve-clone .js-ve-unit'),
        _preview_inner = $('.js-ve-preview-inner'),
        _copy_textarea = $('.js-ve-copy-textarea');
  
    
  /**
   * クローンをつくる
   *
   * @param (number|null) n: 指定した場所にテキストエリアを追加する場合
   */
  const addClone = (n) => {
    let clone = _clone.clone(),
        tgt_current,
        textarea_current,
        tgt,
        textarea;
    
    let is_br = false,
        val = '',
        val_before = '',
        val_after = '';
    
    
    /*
     * フォーム追加
     */
    if (typeof n == 'number') {
      
      // 選択中の次にフォームを追加する
      n++;
      tgt_current = $('.js-ve-unit:nth-child(' + n + ')', _form);
      tgt_current.after(clone);
            
      n++;
      tgt = $('.js-ve-unit:nth-child(' + n + ')', _form);
      
      // 選択中のテキストエリアにテキストがある場合は、選択位置を基準に分割する
      textarea_current = $('.js-ve-textarea', tgt_current);
      val = textarea_current.val();
      val_before = val.substr(0, textarea_current.get(0).selectionStart).trim();
      val_after = val.substr(textarea_current.get(0).selectionEnd).trim();
      
      // 選択中のテキストエリアの情報を更新する
      textarea_current.val(val_before);
      textarea_current.height(1);
      textarea_current.height(textarea_current.get(0).scrollHeight);      
    } else {
      
      // 新規にフォームを追加する
      _form.append(clone);
      tgt = $('.js-ve-unit:last-child', _form);
    }
    
    // 新規フォームのテキストエリアをセットする
    textarea = $('.js-ve-textarea', tgt);
    textarea.val(val_after);
    autoAdjustTextareaHeight(textarea);    
    
    // MEMO: URLにフォーカスされる時があるため、タイムラグを発生させている
    setTimeout(function () {
      textarea.focus();
    }, 100);
    
    // テキストエリアを監視する
    textarea.on('keydown', function (e) {
      let _this = $(this),
          val_this = _this.val(),
          p = _this.closest('.js-ve-unit'),
          next_p = p.next(),
          prev_p = p.prev(),
          next_textarea,
          prev_textarea,
          val_next = '',
          val_prev = '',
          length_next = 0,
          length_prev = 0;
      
      let new_val = '';
      
      // ENTERキーを2回連続で押したら、新規フォームに切り替える
      if (e.keyCode === 13) {
        if (is_br) {
          addClone($('.js-ve-unit', _form).index(p));
          is_br = false;
          
          // MEMO: 2回目のENTER処理を無効にしている重要なポイント
          // ここにreturn処理を記述したくなかったが、可読性重視で記述
          return false;
        } else {
          is_br = true;
        }
      } else {
        is_br = false;

        // その他のキー条件
        switch (true) {

          // DELキーかつ先頭、かつテキストエリアが複数ある場合
          case (e.keyCode === 8 && 
                e.target.selectionStart === 0 && 
                $('.js-ve-unit', _form).length > 0):

            // 現在の前のテキストエリアがあるか判別する
            if (prev_p.length > 0) {
              prev_textarea = $('.js-ve-textarea', prev_p);
              val_prev = prev_textarea.val();
              length_prev = val_prev.length;
              new_val = val_prev + val_this + ' ';

              prev_textarea.val(new_val).focus();

              // MEMO: タイムラグを作ることで削除対象から外す
              setTimeout(function () {
                prev_textarea.get(0).selectionStart = length_prev;
                prev_textarea.get(0).selectionEnd = length_prev;   
              }, 100);

              p.remove();            
            }

            break; 

          // TABキー、かつ最後のテキストエリアの場合
          case (!e.shiftKey && e.keyCode === 9 && next_p.length === 0):
            addClone();
            break;

          // breakなし
        }
      }
    });
    
               
    // 削除する
    $('.js-ve-del', tgt).on('click', function () {
      $(this).closest('.js-ve-unit').remove();
      return false;
    });
    
    // 上へ移動する
    $('.js-ve-up', tgt).on('click', function () {
      let p = $(this).closest('.js-ve-unit'),
          up = p.prev();
        
      p.after(up);
      return false;
    });
    
    // 下へ移動する
    $('.js-ve-down', tgt).on('click', function () {
      let p = $(this).closest('.js-ve-unit'),
          down = p.next();
      
      down.after(p);
      return false;
    });
    
    return false;
  }
  
  
  // フォームを表示する(戻る)
  $('.js-ve-link-back').on('click', function () {
    _form.show();
    _tab_form.show();
    _tab_preview.hide();
    _preview.hide();
    return false;
  });
  
  // 本文をコピーする
  $('.js-ve-link-copy').on('click', function () {    
    _copy_textarea.select();
    document.execCommand('copy');
  });

  // プレビューを表示する
  $('.js-ve-link-preview').on('click', function () {
    let v = '',
        is_first = true;;
    
    // データリセット
    _copy_textarea.val('').height(1);
    
    // データ取得
    $('.js-ve-textarea', _form).each(function () {
      if (!is_first) {
        v += '\n\n';
      } else {
        is_first = false;
      }
      v += $(this).val();
    });
        
    // 画面表示切り替え
    _form.hide();
    _tab_form.hide();
    _preview.show();
    _tab_preview.show();
    
    // データ反映
    // ATTENTION: [画面表示切り替え]後に処理しないと高さを正しく取得できないので注意
    _copy_textarea.val(v).height(_copy_textarea.get(0).scrollHeight);      
    
    return false;
  });
  
  // リセットする
  $('.js-ve-link-clear').on('click', function () {
    if (confirm('完全に削除します。\nよろしいですか？')) {
      _form.html('');
    }
    return false;
  });
  
  // 追加する
  $('.js-ve-link-add').on('click', addClone);
  
  // 初期処理
  addClone();
  
}

$(function () {
  if ($('body').hasClass('voiceentry')) {
    voiceentry();
  }
});