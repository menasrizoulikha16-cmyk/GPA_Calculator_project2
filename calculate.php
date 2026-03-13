1 <? php 
2 if ( isset ( $_POST [’course ’] , $_POST [’credits ’] , $_POST [’grade ’]) ) { 
3 $courses = $_POST [’course ’]; 
4 $credits = $_POST [’credits ’]; 
5 $grades = $_POST [’grade ’]; 
6 $totalPoints = 0; 
7 $totalCredits = 0; 
8 
9 echo "<table >"; 
10 echo "<tr > 
11 <th > Course </th > 
12 <th > Credits </th > 
13 <th >Grade </th > 
14 <th > Grade Points </th > 
15 </tr >"; 
16 
17 for ( $i = 0; $i < count ( $courses ) ; $i ++) { 
18 $course = htmlspecialchars ( $courses [ $i ]) ; 
19 $cr = floatval ( $credits [ $i ]) ; 
20 $g = floatval ( $grades [ $i ]) ; 
21 if ( $cr <= 0) continue ; 
22 $pts = $cr * $g ; 
23 $totalPoints += $pts ; 
24 $totalCredits += $cr ; 
25 echo "<tr > 
26 <td > $course </td > 
27 <td >$cr </td > 
28 <td >$g </td > 
29 <td >$pts </td > 
30 </tr >"; 
31 } 
32 echo " </table >"; 
33 
34 if ( $totalCredits > 0) { 
35 $gpa = $totalPoints / $totalCredits ; 
36 if ( $gpa >= 3.7) { 
37 $interpretation = " Distinction "; 
38 } elseif ( $gpa >= 3.0) { 
39 $interpretation = " Merit "; 
40 } elseif ( $gpa >= 2.0) { 
41 $interpretation = " Pass "; 
42 } else { 
43 $interpretation = " Fail "; 
44 } 
45 echo "<p> Your GPA is <strong >" . number_format ( $gpa , 2) 
46 . " </strong > ( $interpretation ). </p>"; 
47 } else { 
48 echo "<p>No valid courses entered . </p>"; 
49 }
  50 } else { 
51 echo " Data not received ."; 
52 } 
53 ? >
