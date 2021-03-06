<?php header("Content-type: text/xml") ?>
<?xml version="1.0" encoding="ISO-8859-1" standalone="no"?>

<database name="innovative" defaultIdMethod="native">

 <table name="book" description="Book Table">
  <column name="book_id" type="integer" primaryKey="true" autoIncrement="true" required="true" description="Book Id"/>
  <column name="title" type="varchar" size="255" required="true" description="Book Title"/>
  <column name="isbn" type="varchar" size="24" required="true" phpName="ISBN" description="ISBN Number"/>
  <column name="publisher_id" type="integer" required="true" description="Foreign Key for Publisher"/>
  <column name="author_id" type="integer" required="true" description="Foreign Key for Author"/>
  <foreign-key foreignTable="publisher">
    <reference local="publisher_id" foreign="publisher_id"/>
  </foreign-key>
  <foreign-key foreignTable="author">
    <reference local="author_id" foreign="author_id"/>
  </foreign-key>
 </table>

 <table name="publisher" description="Publisher Table">
  <column name="publisher_id" type="integer" required="true" primaryKey="true" autoIncrement="true" description="Publisher Id"/>
  <column name="name" type="varchar" size="128" required="true" description="Publisher Name"/>
 </table>

 <table name="author" description="Author Table">
  <column name="author_id" type="integer" required="true" primaryKey="true" autoIncrement="true" description="Author Id"/>
  <column name="first_name" type="varchar" size="128" required="true" description="First Name"/>
  <column name="last_name" type="varchar" size="128" required="true" description="Last Name"/>
 </table>

</database>