<!doctype html>
<?php include_once('json.php'); ?>
<html>
    <head>
        <title>Gestion de Granulés</title>
        <meta charset="utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script type="text/javascript" src="js/send_data.js"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
          <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/highcharts-3d.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        
          <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        
        <div class="container">
            <?php include('navbar.php'); ?>


 

<div class="row">
    <div class="col-sm-12">
        <p id="TitreCadre"><span class="glyphicon glyphicon-scale"></span> Données</p>
        <div class="table-responsive">
            <form method="post" action="tab.php">
            <table class="table">
                <thead>
                    <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>Volume (h x L x l)</td>
                    <td>
                    <input type="text" class="form-control" name="tvolume" value="333"/>
                    </td>
                        <td>m&sup3;</td>
                    </tr>
                    <tr>
                    <td>Département</td>
                    <td>
                    <select name="departement" size="1" class="form-control">
                                        <option value=1>01</option>
                                        <option value=2>02</option>
                                        <option value=3>03</option>
                                        <option value=4>04</option>
                                        <option value=5>05</option>
                                        <option value=6>06</option>
                                        <option value=7>07</option>
                                        <option value=8>08</option>
                                        <option value=9>09</option>
                                        <option value=10>10</option>
                                        <option value=11>11</option>
                                        <option value=12>12</option>
                                        <option value=13>13</option>
                                        <option value=14>14</option>
                                        <option value=15>15</option>
                                        <option value=16>16</option>
                                        <option value=17>17</option>
                                        <option value=18>18</option>
                                        <option value=19>19</option>
                                        <option value=20>20</option>
                                        <option value=21>21</option>
                                        <option value=22>22</option>
                                        <option value=23>23</option>
                                        <option value=24>24</option>
                                        <option value=25>25</option>
                                        <option value=26>26</option>
                                        <option value=27>27</option>
                                        <option value=28>28</option>
                                        <option value=29>29</option>
                                        <option value=30>30</option>
                                        <option value=31>31</option>
                                        <option value=32>32</option>
                                        <option value=33>33</option>
                                        <option value=34>34</option>
                                        <option value=35>35</option>
                                        <option value=36>36</option>
                                        <option value=37>37</option>
                                        <option value=38>38</option>
                                        <option value=39>39</option>
                                        <option value=40>40</option>
                                        <option value=41>41</option>
                                        <option value=42>42</option>
                                        <option value=43>43</option>
                                        <option value=44>44</option>
                                        <option value=45>45</option>
                                        <option value=46>46</option>
                                        <option value=47>47</option>
                                        <option value=48>48</option>
                                        <option value=49>49</option>
                                        <option value=50>50</option>
                                        <option value=51>51</option>
                                        <option value=52>52</option>
                                        <option value=53>53</option>
                                        <option value=54>54</option>
                                        <option value=55>55</option>
                                        <option value=56>56</option>
                                        <option value=57>57</option>
                                        <option value=58>58</option>
                                        <option value=59>59</option>
                                        <option value=60>60</option>
                                        <option value=61>61</option>
                                        <option value=62>62</option>
                                        <option value=63>63</option>
                                        <option value=64>64</option>
                                        <option value=65>65</option>
                                        <option value=66>66</option>
                                        <option value=67>67</option>
                                        <option value=68>68</option>
                                        <option value=69>69</option>
                                        <option value=70>70</option>
                                        <option value=71>71</option>
                                        <option value=72>72</option>
                                        <option value=73>73</option>
                                        <option value=74>74</option>
                                        <option value=75>75</option>
                                        <option value=76>76</option>
                                        <option value=77>77</option>
                                        <option value=78>78</option>
                                        <option value=79>79</option>
                                        <option value=80>80</option>
                                        <option value=81>81</option>
                                        <option value=82>82</option>
                                        <option value=83>83</option>
                                        <option value=84>84</option>
                                        <option value=85>85</option>
                                        <option value=86>86</option>
                                        <option value=87>87</option>
                                        <option value=88>88</option>
                                        <option value=89>89</option>
                                        <option value=90>90</option>
                                        <option value=91>91</option>
                                        <option value=92>92</option>
                                        <option value=93>93</option>
                                        <option value=94>94</option>
                                        <option value=95>95</option>
                                        <option value=96>2A</option>
                                        <option value=97>2B</option>
                                    </select>    
                    </td>
                        <td></td>
                    </tr>
                    <tr>
                    <td>Altitude</td>
                    <td><input type="text" class="form-control" name="altitude" value="100"/></td>
                        <td>m</td>
                    </tr>
                    <tr>
                    <td>Température jour</td>
                    <td><input type="text" class="form-control" name="TmpDesJ" value="21"/></td><td>°C</td>
                    </tr>
                    <tr>
                    <td>Température nuit</td>
                    <td><input type="text" class="form-control" name="TmpDesN" value="17"/></td>
                        <td>°C</td>
                    </tr>
                    <tr>
                    <td>Coeficient isolation</td>
                    <td>
                            <select name="iso" size="1" class="form-control">
                                        <option value=3>Bonne (m&#251;rs+plafond+portes isol&#233;s)</option>
                                        <option value=2>Moyenne (plafond ou m&#251;rs isol&#233;s)</option>
                                        <option value=1>Faible (m&#251;rs)</option>
                                        <option value=0>In&#233;xistante (pas d isolation)</option>
                            </select>    
                    </td>
                    <td></td>
                    </tr>
                    <tr>
                    <td>Pouvoir calorifique</td>
                    <td><input type="text" class="form-control" name="pcalo" value="5.2"/></td><td>kWh/kg</td>
                    </tr>
                    <tr>
                    <td></td>
                    <td><button type="submit" class="btn btn-success">Enregistrer</button></td>
                    <td></td>
                    </tr>
                </tbody>
            </table>
            </form>
        </div>
                
    </div>
</div>
            <br><br><br><br><br>
        
    
        
            <div>
            <?php include('footer.php'); ?>
            </div>    

        
     </div>    
    </body>
</html>