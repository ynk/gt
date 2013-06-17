/gt
===

A Google Translate simple command line tool (*with an Automator Service*)

- ពាក្យបញ្ជា មួយ របស់ Google បកប្រែ ឧបករណ៍ សាមញ្ញ បន្ទាត់
- ເປັນ ຄໍາສັ່ງ ກູໂກ ແປພາສາ ເປັນເຄື່ອງມື ງ່າຍດາຍ ເສັ້ນ 
- ஒரு Google Translate எளிய கட்டளை வரி கருவியாகும்
- Google Translate yksinkertainen komentorivi työkalu




##Install

Be sure that your php cli has mod_curl activated, and simply link it to wherever you want after adding execution permissions.

```
chmod +x gt.php
ln -s gt.php /usr/local/bin/gt
```

##Use

```
gt <options> <text>

<options> :
-i={lang} : input language of your choice or "auto" for detection feature
-o={lang} : output language of your choice or "random" for random translation
```

##Automator service
Simply copy the `Translate.workflow` file into your `~/Library/Services/` folder.
After that, you will find your new Service into `Preferences/Keyboard/Shortcuts/Services/Text`. It's much cooler with a keyboard shortcut assigned.

Notice that it will work for text inputs only.

I'm currently trying to add an automator to translate in the context menu when highlighting text.

