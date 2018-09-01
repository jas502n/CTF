#encoding=utf-8
import urllib


file1 = open("file1", "rb")
file2 = open("file2", "rb")
res1 = file1.read()
res2 = file2.read()
s1 = urllib.quote(res1)
s2 = urllib.quote(res2)
file1.close()
file2.close()
print 'c=%s'% s1 +'&'+'d=%s'% s2