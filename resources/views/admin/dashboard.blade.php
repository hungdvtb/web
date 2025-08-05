 @section('content')


 <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
 <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
 <style>
     body {
         display: flex;
         font-family: sans-serif;
         width: 100%;
     }

     .form-container,
     .result-container {
         width: 50%;
         padding: 20px;
         box-sizing: border-box;
     }

     .form-group {
         margin-bottom: 12px;
     }

     .container {
         display: flex;
         width: 1350px;
     }

     label {
         font-weight: bold;
         display: block;
     }

     input,
     textarea,
     select {
         width: 100%;
         padding: 5px;
     }

     pre {
         background: #f0f0f0;
         padding: 10px;
         overflow: auto;
         height: 90vh;
     }

     .logs {
         max-height: 200px;
         overflow-y: auto;
         background: #eef;
         padding: 5px;
         margin-top: 10px;
         font-size: 12px;
     }

     img {
         max-width: 100%;
         margin-top: 5px;
     }
 </style>

 <div id="app">
     <div class="row">
       
         <div class="col-sm-6">
             <div class="form-group">
                 <label>Nguồn truyện</label>
                 <select v-model="selectedSource" class="form-control">
                     <option v-for="item in sources" :value="item">[[ item.name ]]</option>
                 </select>
             </div>
             <div class="form-group">
                <label>Categories</label> 
                <select v-model="form.category_id" multiple class="form-control"> 
                    <option v-for="item in options" :key="item" :value="item.id">[[ item.name ]]</option>
                    </select>
             </div>
             <div class="form-group">
                 <label>Link danh sách truyện</label>
                 <input v-model="listpageUrl" type="text" class="form-control">
                 <button @click="fetchAll">Lấy danh sách truyện</button>
             </div>
             <div class="form-group">
                 <label>Link truyện</label>
                 <input v-model="form.orgin_url" type="text" class="form-control">
                 <button @click="fetchStoryInfo">Lấy thông tin truyện</button>
             </div>

             <div class="form-group">
                 <label>Chương bắt đầu tải</label>
                 <input v-model="form.start_url" type="text" class="form-control">
             </div>

             <div class="form-group">
                 <label>Tên truyện</label>
                 <input v-model="form.name" @input="generateSlug" class="form-control">
             </div>

             <div class="form-group">
                 <label>Đường dẫn truyện</label>
                 <input v-model="form.slug" class="form-control">
             </div>
 
             <div class="form-group">
                 <label>Tác giả</label>
                 <input v-model="form.author" type="text" class="form-control">
             </div>

             <div class="form-group">
                 <label>Mô tả</label>
                 <textarea v-model="form.summary" class="form-control"></textarea>
             </div>

             <div class="form-group">
                 <label>Mô tả dài</label>
                 <textarea v-model="form.description" class="form-control"></textarea>
             </div>

             <div class="form-group">
                 <label>Link ảnh</label>
                 <input type="file" @change="uploadImage">
                 <div v-if="form.thumb">
                     <img :src="form.thumb">
                     <small>[[ form.thumb ]]</small>
                 </div>
             </div>

             <div class="form-group">
                 <button @click="crawlChapters" :disabled="isCrawling">Tải chương</button>
                 <button @click="crawlChapters" :disabled="!currentUrl || isCrawling">▶️ Tiếp tục tải chương</button>
                 <button @click="uploadBook" :disabled="loading">
                     [[ loading ? 'Đang đăng...' : 'Đăng truyện' ]]
                 </button>
             </div>

             <div class="logs">
                 <div v-for="log in reversedTexts">[[ log ]]</div>
             </div>
         </div>

         <div class="col-sm-6">
            <h4>Listbook</h4>
           <ul>
            <li v-for="(text, index) in listBooks" :key="index">
                [[text]]
            </li>
            </ul>
               <h4>Json Upload</h4>
             <pre>[[ resultJson ]]</pre>
         </div>
     </div>

 </div>

 <script>
     new Vue({
         el: '#app',
         delimiters: ['[[', ']]'],
         data: {
            listpageUrl: '',
            options: <?php echo json_encode($categories) ?>,
             sources: [{
                     type_code: 'laophatgia', 
                     name: 'laophatgia.net',
                     content_class: '.text-left',
                     next_button_class: '.next_page',
                     name_story_class: '.post-title h1',
                     image_class: '.summary_image img',
                     author_class: '.author-content a',
                     listpage_book_class: '.item-small_thumbnail .page-item-detail .item-summary .post-title a',
                     description_class: '.summary__content ',
                     first_chap: 'chuong-1',
                     need_decript: true,
                 },
                 {
                     type_code: 'truyenfull',
                     name: 'truyenfull',
                     content_class: '#chapter-c',
                     next_button_class: '#next_chap',
                     name_story_class: 'h3.title',
                     image_class: '.info-holder .books .book img',
                     author_class: '.info [itemprop="author"]',
                     description_class: '.desc-text-full ',
                     first_chap: 'chuong-1',
                     need_decript: false,
                 }
             ],
             selectedSource: {},
             loading: false,
            decodeMap:[],

             form: {
                 name: '',
                 slug: '',
                 category_id: [],
                 author: '',
                 summary: '',
                 description: '',
                 thumb: '',
                 start_url: '',
                 orgin_url: '',
                 chapper: []
             },
             logs: [],
             currentUrl: '',
             currentIndex: 1,
             isCrawling: false,
             listBooks: [],
             currentBookIdx: 0,
         },
         mounted(){
           this.selectedSource =  this.sources[0]
         },
         computed: {
             resultJson() {
                 return JSON.stringify({
                     name: this.form.name,
                     slug: this.form.slug,
                     summary: this.form.summary,
                     author: this.form.author,
                     description: this.form.description,
                     thumb: this.form.thumb,
                     category_id: this.form.category_id, 
                     start_url: this.form.start_url,
                     source_type: this.selectedSource?.type_code,
                     orgin_url: this.form.orgin_url,
                     chapper: this.form.chapper
                 }, null, 2);
             },
              reversedTexts() {
                return this.logs.slice().reverse();
                },
                listBooksJS(){
                    return JSON.stringify(this.listBooks)
                }
         },
         methods: {

            async fetchAll(){
                if (!this.selectedSource || !this.listpageUrl) return alert("Điền link và chọn nguồn");
                const contentPage = await this.fetchDataFromURL(this.listpageUrl)
                const doc = new DOMParser().parseFromString(contentPage, 'text/html');
                this.listBooks = [];
                doc.querySelectorAll(this.selectedSource.listpage_book_class).forEach(a => {
                
                    this.listBooks.push(a.href)
                });
                if(this.listBooks.length){
                    this.form.orgin_url = this.listBooks[0]
                    this.fetchStoryInfo();
                }
            },
            cleanData(){
                this.form = {
                 name: '',
                 slug: '',
                 category_id: [],
                 author: '',
                 summary: '',
                 description: '',
                 thumb: '',
                 start_url: '',
                 orgin_url: '',
                 chapper: []
             };
             this.currentUrl = '';
             this.currentIndex = '';
             this.currentBookIdx++;
             if(this.currentBookIdx < this.listBooks.length){
                this.form.orgin_url = this.listBooks[this.currentBookIdx]
                this.fetchStoryInfo();
             }
             
            },
             async uploadBook() {
                 this.loading = true;
                 this.result = null;
                 const payload = JSON.parse(this.resultJson)
                 try {
                     const res = await axios.post('admin/upload-book', payload);
                     this.result = res.data.id;
                     this.logs.push('✅ Đăng truyện thành công: '+ this.form.name);
                     
                 } catch (err) {
                     this.logs.push('❌ Lỗi khi đăng truyện: ' + (err.response?.data?.message || err.message))
                 } finally {
                     this.loading = false;
                     this.cleanData()
                 }
             },
             generateSlug() {
                 var str = this.form.name;
                 str = str.toLowerCase();

                 // Thay thế tiếng Việt có dấu thành không dấu
                 str = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

                 // Thay ký tự đặc biệt thành khoảng trắng
                 str = str.replace(/[^a-z0-9\s-]/g, "");

                 // Thay nhiều khoảng trắng hoặc dấu gạch ngang thành 1 gạch ngang
                 str = str.replace(/[\s\-]+/g, "-");

                 // Xoá dấu gạch ngang đầu/cuối
                 str = str.replace(/^-+|-+$/g, "");

                 this.form.slug = str
             },
             extractBeforeContentStyles(styleText) {
                 const map = {};
                 const regex = /(\.[\w-]+):before\s*{[^}]*content:\s*['"]([^'"]+)['"]/g;
                 let match;
                 while ((match = regex.exec(styleText)) !== null) {
                     map[match[1]] = match[2];
                 }
                 return map;
             },

             async fetchDataFromURL(url){
                const res =   await axios.post('admin/getcontent', {url});
                const data = res.data;
                return data.content;
             },
             async fetchStoryInfo() {
                 if (!this.selectedSource || !this.form.orgin_url) return alert("Điền link và chọn nguồn");
                const contentPage = await this.fetchDataFromURL(this.form.orgin_url)
                const doc = new DOMParser().parseFromString(contentPage, 'text/html');
               
           
                if (this.selectedSource.need_decript) {
                    const styleText = [...doc.querySelectorAll('style')].map(s => s.innerHTML).join('\n');
                    this.decodeMap = this.extractBeforeContentStyles(styleText); 
                } 
                 const decodeEl = selector => {
                     const el = doc.querySelector(selector);

                     if (!el) return '';
                     if (this.selectedSource.need_decript) {
                         Object.keys(this.decodeMap).forEach(sel => {
                             el.querySelectorAll(sel).forEach(span => {
                                 span.innerHTML = this.decodeMap[sel] + span.innerHTML;
                             });
                         });
                     }
                     return el.textContent.trim();
                 };
                 const getImg = (selector) => {
                     const el = doc.querySelector(selector);
                     return el ? el.getAttribute('data-src') || el.src : '';
                 };
                 this.form.start_url = `${this.form.orgin_url}${this.form.orgin_url.endsWith('/') ? '': '/'}${this.selectedSource.first_chap}`;
                 this.form.name = decodeEl(this.selectedSource.name_story_class);
                 this.generateSlug();
                 this.form.thumb = getImg(this.selectedSource.image_class)
                 this.form.summary = decodeEl(this.selectedSource.description_class);
                 this.form.description = this.form.summary;
                 this.form.author = decodeEl(this.selectedSource.author_class);
                 this.crawlChapters();
             },
             async uploadImage(e) {
                 const file = e.target.files[0];
                 if (!file) return;
                 const formData = new FormData();
                 formData.append('file', file);

                 // 👇 Replace this with your actual image upload logic (e.g. S3)
                 const res = await fetch('https://api.imgbb.com/1/upload?key=YOUR_API_KEY', {
                     method: 'POST',
                     body: formData
                 });
                 const result = await res.json();
                 this.form.thumb = result.data.url;
             },
             async crawlChapters() {
                 if (!this.selectedSource || (!this.form.start_url && !this.currentUrl)) return alert("Thiếu thông tin crawl");

                 this.isCrawling = true;
                 this.logs.push(this.currentIndex === 1 ? '📖 Bắt đầu crawl chương...' : '🔄 Tiếp tục crawl chương...');

                 let url = this.currentUrl || this.form.start_url;
                 let index = this.currentIndex;

                 while (url) {
                     try {
                         const contentPage = await this.fetchDataFromURL(url)
                 
                         const doc = new DOMParser().parseFromString(contentPage, 'text/html');
                         if (this.selectedSource.need_decript) {
                            const styleText = [...doc.querySelectorAll('style')].map(s => s.innerHTML).join('\n');
                            this.decodeMap = this.extractBeforeContentStyles(styleText);
                         }
                         const contentEl = doc.querySelector(this.selectedSource.content_class);
                         if (!contentEl) throw new Error('Không tìm thấy nội dung chương');
                         if (this.selectedSource.need_decript) {
                             Object.keys(this.decodeMap).forEach(sel => {
                                 const els = contentEl.querySelectorAll(sel);
                                 els.forEach(el => {
                                     el.innerHTML = this.decodeMap[sel] + el.innerHTML;
                                 });
                             });
                         }

                         let content = contentEl.innerHTML

                         this.form.chapper.push({
                             name: 'Chương ' + index,
                             slug: 'chuong-' + index,
                             content
                         });

                         this.logs.push('✅ Chương ' + index + ' OK');

                         const nextBtn = doc.querySelector(this.selectedSource.next_button_class);
                         if (nextBtn && nextBtn.href) {
                             url = nextBtn.href;
                             index++;
                             this.currentUrl = url;
                             this.currentIndex = index;
                         } else {
                             this.logs.push('✅ Đã lấy hết chương');
                             this.currentUrl = '';
                             this.currentIndex = 1;
                             this.uploadBook();
                             break;
                         }
                     } catch (e) {
                         this.logs.push('❌ Lỗi chương ' + index + ': ' + e.message);
                         this.currentUrl = url;
                         this.currentIndex = index;
                         break;
                     }
                 }

                 this.isCrawling = false;
             }
         }
     });
 </script>


 @endsection