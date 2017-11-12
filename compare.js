
function infoo(id)
{
    document.getElementById(id).style.visibility="visible";
}


function addtocomp(id)
{
    var dom1=document.getElementById('one');
    var dom2=document.getElementById('two');
    var dom3=document.getElementById('three');
    var card=document.getElementById(id).style;

    var str="b"+id+" ";
    var button=document.getElementById(str);
    if(dom1.value=="" )
    {
       dom1.value=id;
       button.value="Remove";
       card.opacity="0.7";

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
               button.value="Add to Compare";
               card.opacity=1;


           }
           else
           {
            dom2.value=id;

            button.value="Remove";
            card.opacity="0.7";

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

                    button.value="Add to Compare";
                    card.opacity=1;

                }
                else
                {
                    if(dom2.value==id)
                    {
                        dom2.value="";

                        button.value="Add to Compare";
                        card.opacity=1;

                    }

                    else
                    {
                        dom3.value=id;

                        button.value="Remove";
                        card.opacity="0.7";
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

                    button.value="Add to Compare";
                    card.opacity=1;

                }
                else
                {
                    if(dom2.value==id)
                    {
                        dom2.value=dom3.value;
                        dom3.value="";

                        button.value="Add to Compare";
                        card.opacity=1;

                    }

                    else
                    {
                        if(dom3.value==id)
                        {
                            dom3.value="";

                            card.opacity=1;
                            button.value="Add to Compare";


                        }

                        else
                        {

                            alert("cannot select more than 3 courses to Compare at a time");


                        }
                    }
                }
                
            }

            
        }

    }

}