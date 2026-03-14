1 <? php 
2 $result = ""; 
3 $tableHtml = ""; 
4 
5 if ( $_SERVER [’ REQUEST_METHOD ’] == ’POST ’) { 
6 $courses = $_POST [’course ’] ?? []; 
7 $credits = $_POST [’credits ’] ?? []; 
8 $grades = $_POST [’grade ’] ?? []; 
9 $totalPoints = 0; 
10 $totalCredits = 0; 
11 
12 $tableHtml = "<table >"; 
13 $tableHtml .= "<tr > 
14 <th > Course </th > <th > Credits </th > 
15 <th >Grade </th > <th > Grade Points </th > 
16 </tr >"; 
17 
18 for ( $i = 0; $i < count ( $courses ) ; $i ++) { 
19 $course = htmlspecialchars ( $courses [ $i ]) ; 
20 $cr = floatval ( $credits [ $i ]) ; 
21 $g = floatval ( $grades [ $i ]) ; 
22 if ( $cr <= 0) continue ; 
23 $pts = $cr * $g ; 
24 $totalPoints += $pts ; 
25 $totalCredits += $cr ; 
26 $tableHtml .= "<tr > 
27 <td > $course </td > <td >$cr </td > 
28 <td >$g </td > <td >$pts </td > 
29 </tr >"; 
30 } 
31 $tableHtml .= " </table >"; 
32 
33 if ( $totalCredits > 0) { 
34 $gpa = $totalPoints / $totalCredits ; 
35 if ( $gpa >= 3.7) { 
36 $interpretation = " Distinction "; 
37 } elseif ( $gpa >= 3.0) { 
38 $interpretation = " Merit "; 
39 } elseif ( $gpa >= 2.0) { 
40 $interpretation = " Pass "; 
41 } else { 
42 $interpretation = " Fail "; 
43 } 
44 $result = " Your GPA is " . number_format ( $gpa , 2) 
45 . " ( $interpretation )."; 
46 } else { 
47 $result = "No valid courses entered ."; 
48 } 
49 } 
50 ? >
51 <! DOCTYPE html > 
52 < html lang ="en"> 
53 < head > 
54 < meta charset ="UTF -8"> 
55 < title > GPA Calculator </ title > 
56 < link rel =" stylesheet " href =" style .css"> 
57 < script src =" script .js" > </ script > 
58 </ head > 
59 < body > 
60 <h1 > GPA Calculator </ h1 > 
61 <? php if ( $result != "") : ? > 
62 <? php echo $tableHtml ; ? > 
63 <p > < strong > <?= $result ? > </ strong > </p > 
64 <? php endif ; ? > 
65 < form action ="" method =" post " onsubmit =" return validateForm ();"> 
66 < div id =" courses "> 
67 < div class ="course - row"> 
68 < label > Course : </ label > 
69 < input type =" text " name =" course []" 
70 placeholder ="e.g. Mathematics " required > 
71 < label > Credits : </ label > 
72 < input type =" number " name =" credits []" 
73 placeholder ="e.g. 3" min ="1" required > 
74 < label > Grade : </ label > 
75 < select name =" grade []"> 
76 < option value ="4.0">A </ option > 
77 < option value ="3.0">B </ option > 
78 < option value ="2.0">C </ option > 
79 < option value ="1.0">D </ option > 
80 < option value ="0.0">F </ option > 
81 </ select > 
82 </ div > 
83 </ div > 
84 < button type =" button " onclick =" addCourse ()"> 
85 + Add Course 
86 </ button > < br > < br > 
87 < input type =" submit " value =" Calculate GPA"> 
88 </ form > 
89 </ body > 
90 </ html >