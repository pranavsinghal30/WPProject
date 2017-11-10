function addtocomp(id)
{
    var dom1=document.getElementById('one');
    var dom2=document.getElementById('two');
    var dom3=document.getElementById('three');
    var card=document.getElementById(id).style;
    if(dom1.value=="" )
    {
       dom1.value=id;
       card.opacity="1";
       card.backgroundColor="white";
    }
    else
    {
        //var dom2=document.getElementById('two');
        if(dom2.value=="")
        {
           
           if(dom1.value==id)
           {
               dom1.value="";
               card.opacity=0.7;

           }
           else
           {
            dom2.value=id;
            card.opacity="1";
            card.backgroundColor="white";

           }
        }

        else
        {
            //var dom3=document.getElementById('three');
            if(dom3.value=="")
            {
                if(dom1.value==id)
                {
                    dom1.value=dom2.value;
                    dom2.value="";
                    card.opacity=0.7;
                }
                else
                {
                    if(dom2.value==id)
                    {
                        dom2.value="";
                        card.opacity=0.7;
                    }

                    else
                    {
                        dom3.value=id;
                        card.opacity="1";
                        card.backgroundColor="white";


                    }
                }
              
            }

            else
            {
                if(dom1.value==id)
                {
                    dom1.value=dom2.value;
                    dom2.value=dom3.value;
                    dom3.value="";
                    card.opacity=0.7;
                }
                else
                {
                    if(dom2.value==id)
                    {
                        dom2.value=dom3.value;
                        dom3.value="";
                        card.opacity=0.7;
                    }

                    else
                    {
                        if(dom3.value==id)
                        {
                            dom3.value="";
                            card.opacity=0.7;

                        }

                        else
                        {
                            alert("cannot select more than 3 courses to compare at a time");

                        }
                    }
                }
                
            }

            
        }

    }

}