# ระบบบัญชีลูกหนี้

ระบบบัญชีลูกหนี้สร้างจากคชสารเว็บเฟรมเวิร์คโดยใช้โปรเจ็ค Personnel มาพัฒนาต่อ
เป็นระบบบันทึกข้อมูลลูกหนี้ (มีการใช้งานจริงอยู่) มีความสามารถในการพิมพ์เอกสารสัญญา คำนวณดอกเบี้ย บันทึกประวัติการชำระเงิน
มีการใช้งาน autocomplete ในการค้นหารายชื่อลูกค้ามาใช้งานในฟอร์ม

## ความต้องการของระบบ

- PHP 5.3 ขึ้นไป
- ext-mbstring
- PDO Mysql

## การติดตั้งและการอัปเกรด

1.  ให้อัปโหลดโค้ดทั้งหมดจากที่ดาวน์โหลด ขึ้นไปบน Server
2.  ในกรณีที่มีการติดตั้งใหม่ ให้เรียกตัวติดตั้ง http://domain.tld/install/ และดำเนินการตามขั้นตอนการติดตั้งจนกว่าจะเสร็จสิ้น
3.  ลบไดเร็คทอรี่ install/ ออก
4.  ในกรณีเป็นการอัปเกรด สามารถนำไฟล์ทั้งหมดไปแทนที่ไฟล์เดิม ยกเว้นไดเร็คทอรี่ install/ โดยไม่ต้องดำเนินการใดๆเพิ่มเติมอีก

## การใช้งาน

เข้าระบบโดย User : `admin@localhost` และ Password : `admin`

## ข้อตกลงการนำไปใช้งาน

- สามารถนำไปใช้งานส่วนตัวได้
- สามารถพัฒนาต่อยอดได้
- มีข้อสงสัยสามารถสอบถามได้ที่บอร์ดของคชสาร https://www.kotchasan.com
- ต้องการให้ผู้เขียนพัฒนาเพิ่มเติม ติดต่อผู้เขียนได้โดยตรง (อาจมีค่าใช้จ่าย)
- ผู้เขียนไม่รับผิดชอบข้อผิดพลาดใดๆในการใช้งาน
- ห้ามขาย ถ้าต้องการนำไปพัฒนาต่อเพื่อขายให้ติดต่อผู้เขียนก่อน (เพื่อบริจาค)

## หากต้องการสนับสนุนผู้เขียน สามารถบริจาคช่วยเหลือค่า Server ได้ที่

```
ธนาคาร กสิกรไทย สาขากาญจนบุรี
เลขที่บัญชี 221-2-78341-5
ชื่อบัญชี กรกฎ วิริยะ
```