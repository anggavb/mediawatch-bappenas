# 📘 **Dokumentasi Implementasi Full-Text Search PostgreSQL di Laravel**

Dokumen ini menjelaskan cara mengimplementasikan pencarian teks tingkat lanjut (Full-Text Search / FTS) di aplikasi Laravel menggunakan fitur bawaan PostgreSQL (`tsvector`, `tsquery`, `GIN index`, dan `ts_headline`).

FTS digunakan untuk mencari artikel secara cepat dan relevan berdasarkan kolom **judul** dan **konten**, mendukung **multiple keyword**, dan memberikan **ranking relevansi**.

---

# 1. **Tujuan**

* Membuat sistem pencarian artikel berdasarkan konten dan judul dengan performa tinggi.
* Mendukung dokumen panjang (2.000–5.000 karakter).
* Mendukung 50–500+ artikel (scalable).
* Mendukung banyak keyword sekaligus.
* Menghasilkan ranking relevansi & highlight (snippet).

---

# 2. **Teknologi yang Digunakan**

* **Laravel** (backend)
* **PostgreSQL** (database)
* Fitur PostgreSQL:

  * `tsvector`
  * `websearch_to_tsquery`
  * `ts_rank_cd`
  * `GIN INDEX`
  * `ts_headline`
  * `tsvector_update_trigger`

---

# 3. **Struktur Penyimpanan FTS**

Kita menambahkan kolom khusus berisi bentuk terindeks dari teks, yaitu:

```
search_vector tsvector
```

Kolom ini berisi gabungan indeks dari:

* judul (weight A → lebih penting)
* konten (weight B)

Kolom akan diperbarui **otomatis** melalui trigger PostgreSQL.

---

# 4. **Migration Database**

Migration mencakup:

* pembuatan tabel `articles`
* penambahan kolom `search_vector`
* inisialisasi data awal
* pembuatan GIN index
* pembuatan trigger otomatis update search_vector

### Poin inti struktur FTS di migration:

```sql
ALTER TABLE articles ADD COLUMN search_vector tsvector;

UPDATE articles
SET search_vector =
    setweight(to_tsvector('simple', coalesce(judul,'')), 'A') ||
    setweight(to_tsvector('simple', coalesce(konten,'')), 'B');

CREATE INDEX articles_search_vector_gin
ON articles USING GIN(search_vector);

CREATE TRIGGER articles_search_vector_update
BEFORE INSERT OR UPDATE ON articles
FOR EACH ROW EXECUTE FUNCTION
tsvector_update_trigger(
    search_vector,
    'pg_catalog.simple',
    judul,
    konten
);
```

---

# 5. **Model**

Model `Article` hanya perlu menampung field dasar seperti biasa. Tidak ada konfigurasi khusus untuk FTS di level model.

---

# 6. **Endpoint Pencarian**

Endpoint menerima request berupa:

```json
{
  "keywords": ["bioekonomi", "Workshop Bioekonomi Indonesia 2025"]
}
```

Keyword digabung menjadi query:

```
bioekonomi OR Workshop Bioekonomi Indonesia 2025
```

Kemudian diproses menggunakan `websearch_to_tsquery`, memungkinkan pencarian frasa, OR, dan matching natural.

---

# 7. **Query PostgreSQL untuk FTS**

Pencarian memanfaatkan:

* `search_vector @@ websearch_to_tsquery(...)`
* ranking relevansi: `ts_rank_cd`
* snippet highlight: `ts_headline`

Contoh inti query:

```sql
SELECT
  id, judul, url, tanggal_publish, speaker,
  ts_rank_cd(search_vector, websearch_to_tsquery('simple', :query)) AS rank,
  ts_headline('simple', konten, websearch_to_tsquery('simple', :query),
              'StartSel=<mark>,StopSel=</mark>,MaxFragments=2,MaxWords=35') AS snippet
FROM articles
WHERE search_vector @@ websearch_to_tsquery('simple', :query)
ORDER BY rank DESC
```

---

# 8. **Hasil Pencarian**

Response API menghasilkan:

* artikel terurut berdasarkan **rank**
* potongan konten yang relevan (**snippet**) dengan highlight `<mark>`
* kolom lengkap artikel

Contoh:

```json
{
  "total": 1,
  "query": "bioekonomi OR Workshop Bioekonomi Indonesia 2025",
  "results": [
    {
      "id": 123,
      "judul": "Workshop Bioekonomi Indonesia 2025",
      "rank": 0.345,
      "snippet": "Deputi ... <mark>Bioekonomi</mark> kini menjadi agenda penting..."
    }
  ]
}
```

---

# 9. **Keuntungan Menggunakan PostgreSQL FTS**

| Fitur             | PostgreSQL FTS            |
| ----------------- | ------------------------- |
| Performa          | Sangat cepat (GIN index)  |
| Dokumen panjang   | Sangat cocok              |
| Ranking relevansi | Ya                        |
| Multiple keyword  | Ya (OR / AND)             |
| Search natural    | Ya (websearch_to_tsquery) |
| Highlight hasil   | Ya                        |
| Beban Laravel     | Minim                     |

---

# 10. **Catatan Teknis**

* Gunakan PostgreSQL versi ≥ 11.
* Gunakan konfigurasi FTS `'simple'` untuk Bahasa Indonesia (stemmer Inggris tidak cocok).
* Set weight judul lebih tinggi agar ranking lebih akurat.
* Trigger memastikan `search_vector` selalu terupdate tanpa logic tambahan di Laravel.
* Untuk hasil lebih cepat, batasi hasil (mis. LIMIT 200 atau pagination).

---

# 11. **Alur Kerja Singkat Sistem FTS**

1. Laravel menyimpan artikel ke DB.
2. Trigger otomatis mengupdate `search_vector`.
3. Ketika user mencari:

   * keyword digabung → `websearch_to_tsquery`
   * PostgreSQL melakukan pencarian via GIN index
   * ranking dihitung
   * snippet dirender
4. API mengembalikan hasil + highlight.

---

Jika ingin, saya bisa buatkan versi dokumentasi PDF atau Markdown yang lebih formal / corporate-ready.
