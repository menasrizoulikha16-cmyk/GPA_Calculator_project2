1 <? php 
2 header (’Content - Type : application / json ’) ; 
3 
4 if ( isset ( $_POST [’course ’] , $_POST [’credits ’] , $_POST [’grade ’]) ) { 
5 $courses = $_POST [’course ’]; 
6 $credits = $_POST [’credits ’]; 
7 $grades = $_POST [’grade ’]; 
8 $totalPoints = 0; 
9 $totalCredits = 0; 
10 
11 $tableHtml = ’<table class =" table table - bordered mt -3" > ’; 
12 $tableHtml .= ’<thead class =" thead - dark " > 
13 <tr > 
14 <th > Course </th > <th > Credits </th > 
15 <th >Grade </th > <th > Grade Points </th > 
16 </tr > 
17 </thead > <tbody >’; 
18 
19 for ( $i = 0; $i < count ( $courses ) ; $i ++) { 
20 $course = htmlspecialchars ( $courses [ $i ]) ; 
21 $cr = floatval ( $credits [ $i ]) ; 
22 $g = floatval ( $grades [ $i ]) ; 
23 if ( $cr <= 0) continue ; 
24 $pts = $cr * $g ; 
25 $totalPoints += $pts ; 
26 $totalCredits += $cr ; 
27 $tableHtml .= "<tr > 
28 <td > $course </td > <td >$cr </td > 
29 <td >$g </td > <td >$pts </td > 
30 </tr >"; 
31 } 
32 $tableHtml .= ’ </tbody > </ table >’; 
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
45 $message = " Your GPA is " . number_format ( $gpa , 2) 
46 . " ( $interpretation )."; 
47 echo json_encode ([ 
48 ’success ’ = > true , 
49 ’gpa ’ = > $gpa , 
50 ’message ’ = > $message , 
51 ’tableHtml ’ = > $tableHtml , 
52 ]) ; 
53 } else { 
54 echo json_encode ([ 
55 ’success ’ = > false , 
56 ’message ’ = > ’No valid courses entered .’, 
57 ]) ; 
58 } 
59 } else { 
60 echo json_encode ([ 
61 ’success ’ = > false , 
62 ’message ’ = > ’Data not received .’, 
63 ]) ; 
64 } 
65 exit ; 
66 ? >
