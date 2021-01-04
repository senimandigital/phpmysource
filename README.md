# phpmysource
Mengelola seluruh source yang berpotensi dapat dikostumasi pada komputer lokal.

PhpMySource awalnya kami tulis dengan PHP5 dan sekarang versi PHP sudah mencapai Versi PHP8, jadi proyek ini kami reset dan tulis ulang supaya work dengan Versi PHP8.

## Petunjuk untuk pelajar
Setiap source memiliki versi masing-masing, versi terdahulu memang sengaja kami arsipkan demikian agar dapat digunakan kembali untuk memulai proyek lain. Anda yang sedang belajar dianjurkan untuk melihat sejarah perubahan script. Arsip yang lebih lama lebih mudah untuk dikostumasi dan dibuat variasi daripada harus memodifikasi script akhir yang sudah memiliki fungsi yang sangat sfesifik.

Versi pertama dari setiap source merupakan bagian fundamental, dibuat sengaja untuk tidak menyertakan system keamanan dan fitur-fitur yang bersifat aksesories. semakin baru versi source maka akan semakin sfesifik pula fungsi-nya yang berarti semakin sulit dijadikan bahan pembelajaran. Senimandigital konsisten dalam mempertahankan pola versi seperti ini, sehingga meskipun tidak tersedia dokumentasi belajar dari arsip sejarah akan memberikan anda pemahaman yang jauh lebih baik dari yang bisa anda dapatkan melalui dokumentasi.

### Wawasan Fundamental
1. PhpMySource dibuat untuk bekerja dikomputer lokal, lebih ditujukan untuk membantu kita mengelola source agar dapat bekerja lebih cepat.
2. PhpMySource ditulis untuk bekerja dengan satu file untuk satu tujuan, dengan demikian anda tidak perlu membuka file lain untuk memahami bagimana kode program bekerja.
3. PhpMySource berisi kode program yang optimal dan fundamental dimana masing-masing file akan berisi kurang dari seratus baris kode program.

### Bagaimana cara terbaik mempelajari / mengembangkan PhpMySource... ?
1. PhpMySource menggunakan Senimandgital Framework, yang artinya anda hanya perlu mempelajari kode html untuk membuat aplikasi.
2. PhpMysource jika ingin dikembangkan lebih mutakhir anda hanya perlu memodifikasi 2 buah file, satu file php didalam folder Connection dan satu file javascript bisa bernama magic.js dan bisa bernama script_footer.js.

###### Bagaimana Senimandigital Framework memungkinkan penggunanya bisa mengembangkan aplikasi dinamis hanya dengan mempelajari HTML dan query SQL... ?
1. Jawabanya sebenarnya adalah tehnik pemrograman automatisasi, memungkinkan pengguna hanya perlu menulis Query dan kode HTML. Anda mungkin tidak mendapatkan pemahaman yang memadai sebelum benar-benar menggunakan-nya. Senimandigital framework berbeda dari Framework lain yang menjauhkan penggunanya dari hal-hal native. Dalam hal ini Senimandifital Framework lebih fokus untuk mengembangkan konsep-konsep dan penangan tambahan untuk kode yang Native.
2. Senimandigital Framework akan membaca kode aplikasi dan memproses ulang, misal anda menuliskan satu Query SQL maka Senimandigital Framework akan memproses ulang query tadi sesuai permintaan dari Browser, jika browser meminta output query dalam format JSON maka kode program yang anda tulis akan di batalkan dan request dari Browser yang akan dipenuhi. Bagimana hal seperti ini bisa terjasi, jawabanya ada didalam folder Connection/senimandigital.php.
3. Begitu pula untuk kode html yang anda tulis, ketika anda menulis <textarea data-format="php" maka senimandigital framework akan mengincludekan codemirror secara otomatis kedalam kode program yang akan dikirim ke browser.
