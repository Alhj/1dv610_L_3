# L3 

## what you need to run

* . php 5.6
* . a env.php file get the code from env.php.default an add information that need to be given there
* . a json file where you can add snipps to with [] in it


#UserCase

##Us 1 ViewSnipps

# main cinario

* 1. start with user whants to see snipps 
* 2. user press the see snipps link
* 3. Users see all the snipps

## US 2 AddSnip

* 1. start with user loggin
* 2. user press add snipps link
* 3. fills the input form with input
* 4. snipp save and user get a message that the snipp is created 

## US 3 User what to dealte a snipp of theres

* 1.

## Test cases

# 1.1 view snipp

*    1. press see snipps
*    2. see all the snipps in the json file on the side

# 1.2 add Snipp 

## pre condition 
    
    user is loggin

#1.2.1 all done correct

* 1. press add snipp link
* 2. write in title input hello world
* 3. in the snip textarea write console.log(hello world)
* 4. press to submit button;
* 5. get a message with code snipp create;

#1.2.2 alt no input in title

* 1. press add snipp link
* 2. in the snip textarea write console.log(hello world)
* 3. press to submit button;
* 4. get a message with title is missing input;

#1.2.3 alt no input in string

* 1. press add snipp link
* 2. write in title input hello world
* 3. press to submit button;
* 4. get a message with snipp is missing input;