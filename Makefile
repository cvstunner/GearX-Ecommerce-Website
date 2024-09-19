pjroject_path=/home/cvstunner/data/Programming/web/projects/GigaGear
entry_file = gearx/public
port=7002

all: localhost

localhost:
	php -S localhost:${port} -t ${entry_file}
